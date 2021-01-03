<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Share\Entity\CreatedTrait;
use App\Domain\Share\Entity\DeletedTrait;
use App\Domain\Share\Entity\IDTrait;
use App\Domain\User\Query\RoleViewInterface;
use App\Domain\User\Query\UserViewInterface;
use Doctrine\Common\Collections\ArrayCollection;

class User implements UserViewInterface
{
    use IDTrait;
    use DeletedTrait;
    use CreatedTrait;

    private $email;
    private $hashedPassword;
    private $username;
    private $locale;
    private $resetToken;
    private $timezone;
    private $packings;

    /**
     * @var ArrayCollection
     */
    private $roles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->packings = new ArrayCollection();
    }

    public function email(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return \App\Domain\User\Query\UserViewInterface
     */
    public function setEmail(string $email): UserViewInterface
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param string $hashedPassword
     * @return User
     */
    public function setHashedPassword(string $hashedPassword): UserViewInterface
    {
        $this->hashedPassword = $hashedPassword;

        return $this;
    }

    public function hashedPassword(): string
    {
        return $this->hashedPassword;
    }

    /**
     * @return array
     */
    public function roles(): array
    {
        $roleNames = [];
        /** @var \App\Domain\User\Role $role */
        foreach ($this->roles as $role) {
            $roleNames[] = $role->name();
        }
        return $roleNames;
    }

    /**
     * @param \App\Domain\User\Query\RoleViewInterface $role
     */
    public function addRole(RoleViewInterface $role)
    {
        $this->roles->add($role);
    }


    /**
     * @return string
     */
    public function locale(): string
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function timezone(): string
    {
        return $this->timezone;
    }

    /**
     * @param mixed $resetToken
     * @return User
     */
    public function setResetToken($resetToken)
    {
        $this->resetToken = $resetToken;

        return $this;
    }

    /**
     * @param mixed $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function setLocale(string $locale)
    {
        $this->locale = $locale;

        return $this;
    }

    public function setTimezone(string $timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }
}
