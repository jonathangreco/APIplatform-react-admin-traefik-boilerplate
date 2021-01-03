<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 30/01/2019
 */
declare(strict_types=1);

namespace App\Security\Auth;

use App\Domain\User\Repository\UserReadModelRepositoryInterface;
use App\Domain\User\ValueObject\Email;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class AuthProvider implements UserProviderInterface
{
    /**
     * @param $email
     * @return \App\Security\Auth\Auth
     * @throws \Assert\AssertionFailedException
     */
    public function loadUserByUsername($email)
    {
        /** @var \App\Domain\User\Query\UserViewInterface $user */
        $user = $this->userReadModelRepository->oneByEmail(Email::fromString($email));

        return Auth::fromUser($user);
    }

    /**
     * Refreshes the user.
     *
     * It is up to the implementation to decide if the user data should be
     * totally reloaded (e.g. from the database), or if the UserInterface
     * object can just be merged into some internal array of users / identity
     * map.
     *
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     * @return \Symfony\Component\Security\Core\User\UserInterface
     * @throws \Assert\AssertionFailedException
     */
    public function refreshUser(UserInterface $user)
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * Whether this provider supports the given user class.
     *
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return Auth::class === $class;
    }

    /**
     * AuthProvider constructor.
     * @param UserReadModelRepositoryInterface $userReadModelRepository
     */
    public function __construct(UserReadModelRepositoryInterface $userReadModelRepository)
    {
        $this->userReadModelRepository = $userReadModelRepository;
    }

    /**
     * @var UserReadModelRepositoryInterface
     */
    private $userReadModelRepository;
}
