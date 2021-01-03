<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 30/05/2018
 */
declare(strict_types = 1);

namespace App\Domain\Share\Entity;

trait TitleTrait
{
    /**
     * @var string
     */
    private $title;

    /**
     * @return mixed
     */
    public function title(): ?string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return $this
     */
    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }

}