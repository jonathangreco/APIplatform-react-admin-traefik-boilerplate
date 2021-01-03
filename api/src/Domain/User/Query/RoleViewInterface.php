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
interface RoleViewInterface
{
    public function id(): ?int;

    public function name(): ?string;

    public function description(): ?string;
}
