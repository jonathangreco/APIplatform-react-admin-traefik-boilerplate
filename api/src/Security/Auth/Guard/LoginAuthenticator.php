<?php

declare(strict_types=1);

namespace App\Security\Auth\Guard;

use App\Security\Auth\Auth;
use App\Domain\User\ValueObject\Auth\Credentials;
use App\Domain\User\ValueObject\Auth\HashedPassword;
use App\Domain\User\ValueObject\Email;
use Assert\InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

final class LoginAuthenticator extends AbstractFormLoginAuthenticator
{
    private const LOGIN = 'login';

    private const SUCCESS_REDIRECT = 'profile';

    /**
     * Does the authenticator support the given Request?
     *
     * If this returns false, the authenticator will be skipped.
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return bool
     */
    public function supports(Request $request): bool
    {
        return $request->getPathInfo() === $this->router->generate(self::LOGIN) && $request->isMethod('POST');
    }

    /**
     * Get the authentication credentials from the request and return them
     * as any type (e.g. an associate array).
     *
     * Whatever value you return here will be passed to getUser() and checkCredentials()
     *
     * For example, for a form login, you might:
     *
     *      return array(
     *          'username' => $request->request->get('_username'),
     *          'password' => $request->request->get('_password'),
     *      );
     *
     * Or for an API token that's on a header, you might use:
     *
     *      return array('api_key' => $request->headers->get('X-API-TOKEN'));
     *
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return mixed Any non-null value
     */
    public function getCredentials(Request $request)
    {
        return [
            'email'    => $request->request->get('email'),
            'password' => $request->request->get('password'),
        ];
    }

    /**
     * Return a UserInterface object based on the credentials.
     *
     * The *credentials* are the return value from getCredentials()
     *
     * You may throw an AuthenticationException if you wish. If you return
     * null, then a UsernameNotFoundException is thrown for you.
     *
     *
     * @param $credentials
     * @param \Symfony\Component\Security\Core\User\UserProviderInterface $userProvider
     * @return null|\Symfony\Component\Security\Core\User\UserInterface
     * @throws \Assert\AssertionFailedException
     *
     * @see https://symfony.com/doc/current/messenger/handler_results.html
     * @desc Auth the user
     */
    public function getUser($credentials, UserProviderInterface $userProvider): ?UserInterface
    {
        $invalidCredentials = "error.invalid-credentials";
        try {
            $email = Email::fromString($credentials['email']);
            $plainPassword = $credentials['password'];

            /** @var Auth $user */
            $user = $userProvider->loadUserByUsername($email->toString());


            // Auth the user then send connexion Command.
            $userCredentials = new Credentials($email, HashedPassword::fromHash($user->getPassword()));

            // Plain password compared
            $match = $userCredentials->password->match($plainPassword);

            if (!$match) {
                throw new \Exception($invalidCredentials);
            }

            return $user;
        } catch (InvalidArgumentException $exception) {
            throw new AuthenticationException($invalidCredentials);
        } catch (\Exception $exception) {
            throw new AuthenticationException($invalidCredentials);
        }
    }

    /**
     * Returns true if the credentials are valid.
     *
     * If any value other than true is returned, authentication will
     * fail. You may also throw an AuthenticationException if you wish
     * to cause authentication to fail.
     *
     * The *credentials* are the return value from getCredentials()
     *
     *
     *
     * @param $credentials
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     * @return bool
     */
    public function checkCredentials($credentials, UserInterface $user): bool
    {
        return true;
    }

    /**
     * Called when authentication executed and was successful!
     *
     * This should return the Response sent back to the user, like a
     * RedirectResponse to the last page they visited.
     *
     * If you return null, the current request will continue, and the user
     * will be authenticated. This makes sense, for example, with an API.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token
     * @param string $providerKey The provider (i.e. firewall) key
     * @return null|\Symfony\Component\HttpFoundation\Response
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey): ?Response
    {
        return null;
    }

    protected function getLoginUrl(): string
    {
        return $this->router->generate(self::LOGIN);
    }

    /**
     * Command bus because it launch a command, but there is not at the moment a distinction between query and command bus
     * LoginAuthenticator constructor.
     * @param \Symfony\Component\Routing\Generator\UrlGeneratorInterface $router
     */
    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @var UrlGeneratorInterface
     */
    private $router;
}
