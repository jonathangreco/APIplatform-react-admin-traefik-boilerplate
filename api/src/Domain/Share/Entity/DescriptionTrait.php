<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 04/06/2018
 */
declare(strict_types = 1);

namespace App\Domain\Share\Entity;

trait DescriptionTrait
{
    /**
     * @var string
     */
    private $description;

    /**
     * @return null|string
     */
    public function description(): ?string
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}