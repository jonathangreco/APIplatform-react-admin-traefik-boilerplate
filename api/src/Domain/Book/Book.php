<?php

declare(strict_types=1);

namespace App\Domain\Book;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Domain\Book\Query\BookViewInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     itemOperations={
 *         "get",
 *         "delete",
 *         "patch",
 *         "put"
 *     },
 *     collectionOperations={
 *         "get"={
 *              "normalization_context"={
 *                  "groups"={"book"}
 *              }
 *     },
 *         "post"
 *     }
 * )
 */
class Book implements BookViewInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     * @Groups("book")
     */
    public string $name;

    /**
     * @var \DateTime
     * @Groups("book")
     */
    public $created;

    /**
     * @var \DateTimeImmutable
     * @Groups("book")
     */
    public $deleted;

    /**
     * @var string
     * @Groups("book")
     */
    public $description;

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

    /**
     * @return mixed
     */
    public function deleted(): ?\DateTimeInterface
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
    /**
     * @return mixed
     */
    public function created(): ?\DateTime
    {
        return $this->created;
    }

    /**
     * @param  \DateTimeInterface $created
     * @return self
     */
    public function createdAt(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }
    /**
     * @return mixed
     */
    public function id(): ?int
    {
        return (int) $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

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
