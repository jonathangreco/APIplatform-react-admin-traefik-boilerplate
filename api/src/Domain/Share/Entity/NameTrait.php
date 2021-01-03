<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 30/05/2018
 */
declare(strict_types = 1);

namespace App\Domain\Share\Entity;

trait NameTrait
{
    /**
     * @var string
     */
    private $name;

    /**
     * @return null|string
     */
    public function name(): ?string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return $this
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }
}