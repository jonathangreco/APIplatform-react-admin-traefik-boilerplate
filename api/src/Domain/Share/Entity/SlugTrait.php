<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 06/06/2018
 */
declare(strict_types = 1);

namespace App\Domain\Share\Entity;

trait SlugTrait
{
    /**
     * @var string
     */
    private $slug;

    /**
     * @return string
     */
    public function slug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return $this
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}