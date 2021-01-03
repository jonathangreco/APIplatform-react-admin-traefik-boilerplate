<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 07/02/2019
 */
declare(strict_types=1);

namespace App\Domain\Share\Entity;

trait IDTrait
{
    /**
     * @var int
     */
    private $id;

    /**
     * @return mixed
     */
    public function id(): ?int
    {
        return (int) $this->id;
    }

    /**
     * @param mixed $id
     * @return IdTrait
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }
}