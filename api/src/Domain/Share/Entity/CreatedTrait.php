<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 30/05/2018
 */

namespace App\Domain\Share\Entity;

trait CreatedTrait
{
    private $created;

    /**
     * @return mixed
     */
    public function created(): ?\DateTime
    {
        return $this->created;
    }

    /**
     * @param  \DateTime $created
     * @return self
     */
    public function createdAt(\DateTime $created): self
    {
        $this->created = $created;

        return $this;
    }
}