<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 30/05/2018
 */
declare(strict_types = 1);

namespace App\Domain\Share\Entity;

trait DeletedTrait
{
    /**
     * @var \DateTimeImmutable
     */
    private $deleted;

    /**
     * @return mixed
     */
    public function deleted(): ?\DateTimeImmutable
    {
        return $this->deleted;
    }

    /**
     * @param mixed $deleted
     * @return self
     */
    public function deletedAt($deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }
}