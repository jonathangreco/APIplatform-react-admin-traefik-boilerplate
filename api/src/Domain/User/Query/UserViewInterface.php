<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 30/01/2019
 */
declare(strict_types=1);

namespace App\Domain\User\Query;


/**
 * Interface UserViewInterface a projection allow us to determine what fields will be shown to the user
 * @package App\Domain\User\Query\Projections
 */
interface UserViewInterface
{
    public function id(): ?int;

    public function email(): string;

    public function hashedPassword(): string;

    public function roles(): array;

    public function timezone(): string;

    public function locale(): string;
}
