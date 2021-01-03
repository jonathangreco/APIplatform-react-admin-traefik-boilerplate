<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 31/01/2019
 */
declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Share\Entity\IDTrait;
use App\Domain\Share\Entity\NameTrait;
use App\Domain\User\Query\RoleViewInterface;

class Role implements RoleViewInterface
{
    use IDTrait;
    use NameTrait;

    private $description;

    public function description(): ?string
    {
        return $this->description;
    }
}
