<?php

declare(strict_types=1);

namespace App\Domain\Book;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Domain\Book\Query\BookViewInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"book"}},
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
    private string $name;

    /**
     * @var \DateTime
     * @Groups("book")
     */
    private $created;

    /**
     * @var \DateTimeImmutable
     * @Groups("book")
     */
    private $deleted;

    /**
     * @var string
     * @Groups("book")
     */
    private $description;

    /**
     * @return null|string
     */
    public function getDescription(): ?string
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
     * @return \DateTimeInterface
     */
    public function getCreated(): \DateTimeInterface
    {
        return $this->created;
    }

    /**
     * @param \DateTimeInterface $created
     * @return Book
     */
    public function setCreated(\DateTimeInterface $created): Book
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDeleted(): ?\DateTimeInterface
    {
        return $this->deleted;
    }

    /**
     * @param \DateTimeInterface $deleted
     * @return Book
     */
    public function setDeleted(\DateTimeInterface $deleted): Book
    {
        $this->deleted = $deleted;
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
    public function getName(): ?string
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
