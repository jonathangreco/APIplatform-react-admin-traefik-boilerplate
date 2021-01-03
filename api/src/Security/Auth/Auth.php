<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 30/01/2019
 */
declare(strict_types=1);

namespace App\Security\Auth;

use App\Domain\User\Query\UserViewInterface;
use Symfony\Component\Security\Core\Encoder\EncoderAwareInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class Auth, a Basic DTO, for simplicity it's in infrastructure, but it clearly should be in application
 * @package App\Infrastructure\User\Auth
 */
class Auth implements UserInterface, EncoderAwareInterface
{
    /** @var UserViewInterface */
    private $user;

    public static function fromUser(UserViewInterface $user): self
    {
        return new self($user);
    }

    /**
     * Gets the name of the encoder used to encode the password.
     *
     * If the method returns null, the standard way to retrieve the encoder
     * will be used instead.
     *
     * @return string
     */
    public function getEncoderName()
    {
        return 'bcrypt';
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return array('ROLE_USER');
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     * @return array
     */
    public function getRoles(): array
    {
        return $this->user->roles();
    }

    public function getLocale()
    {
        return $this->user->locale();
    }

    public function getTimezone()
    {
        return $this->user->timezone();
    }

    /**
     * @return string The password
     */
    public function getPassword()
    {
        return $this->user->hashedPassword();
    }

    /**
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->user->email();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        //Noop
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->user->id();
    }

    public function __toString(): string
    {
        return $this->user->email();
    }

    public function getUser()
    {
        return $this->user;
    }

    private function __construct(UserViewInterface $user)
    {
        $this->user = $user;
    }
}
