<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 09/04/2019
 */
declare(strict_types=1);

namespace App\Domain\User\Repository;

use App\Domain\User\Query\RoleViewInterface;
use App\Domain\User\ValueObject\Role;

interface RoleRepositoryInterface
{
    public function oneByName(Role $role): RoleViewInterface;
}
