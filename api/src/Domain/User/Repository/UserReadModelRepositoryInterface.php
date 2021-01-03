<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 30/01/2019
 */
declare(strict_types=1);

namespace App\Domain\User\Repository;

use App\Domain\User\Query\UserViewInterface;
use App\Domain\User\ValueObject\Email;

/**
 * Interface allowing to query against the database
 * Interface UserReadModelRepositoryInterface
 * @package App\Domain\User\Query\Repository
 */
interface UserReadModelRepositoryInterface
{
    public function oneById(int $id): UserViewInterface;

    public function oneByEmail(Email $email): UserViewInterface;

    public function add(UserViewInterface $userRead): void;

    public function existsEmail(Email $email): ?int;

    public function apply(): void;
}
