<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 09/04/2019
 */
declare(strict_types=1);

namespace App\Cli\Service;

use App\Domain\User\Repository\RoleRepositoryInterface;
use App\Domain\User\Repository\UserReadModelRepositoryInterface;
use App\Domain\User\User;
use App\Domain\User\ValueObject\Auth\HashedPassword;
use App\Domain\User\ValueObject\Email;

class UserCliService
{

    /**
     * @var \App\Domain\User\Repository\UserReadModelRepositoryInterface
     */
    private $userModel;

    /**
     * @var \App\Domain\User\Repository\RoleRepositoryInterface
     */
    private $roleRepo;

    public function __construct(UserReadModelRepositoryInterface $userModel, RoleRepositoryInterface $roleRepo)
    {
        $this->userModel = $userModel;
        $this->roleRepo = $roleRepo;
    }

    /**
     * CreateUser constructor.
     * @param string $email
     * @param string $pass
     * @param string $username
     * @param string $role
     * @param string $locale
     * @param string $timezone
     * @return \App\Domain\User\User
     * @throws \Assert\AssertionFailedException
     * @throws \Exception
     */
    public function create($email, $pass, $username, $role, $locale, $timezone)
    {
        $locale =  ($locale) ?: "fr";
        $timezone =  ($timezone) ?: "Europe/Paris";
        $roleValue = \App\Domain\User\ValueObject\Role::fromString($role);
        $roleObject = $this->roleRepo->oneByName($roleValue);

        $user = new User();
        $user->createdAt(new \DateTime());
        $user->setEmail((Email::fromString($email))->toString());
        $user->setHashedPassword((HashedPassword::encode($pass))->toString());
        $user->addRole($roleObject);
        $user->setUsername($username);
        $user->setLocale($locale);
        $user->setTimezone($timezone);

        $this->userModel->add($user);

        return $user;
    }

}
