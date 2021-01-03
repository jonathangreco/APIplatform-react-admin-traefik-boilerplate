<?php

declare(strict_types=1);

namespace App\Domain\Book;

use App\Domain\Book\Query\BookViewInterface;
use App\Domain\Share\Entity\CreatedTrait;
use App\Domain\Share\Entity\DeletedTrait;
use App\Domain\Share\Entity\DescriptionTrait;
use App\Domain\Share\Entity\IDTrait;
use App\Domain\Share\Entity\NameTrait;

class Book implements BookViewInterface
{
    use IDTrait;
    use DeletedTrait;
    use CreatedTrait;
    use NameTrait;
    use DescriptionTrait;
}
