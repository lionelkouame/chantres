<?php

namespace App\SongManagement\Domain\Category\Event;

use App\SongManagement\Domain\Category\ValueObject\CategoryId;
use App\SongManagement\Domain\Category\ValueObject\CategoryName;

final readonly class CategoryCreated implements CategoryEventInterface
{
    public function __construct(
        public CategoryId $id,
        public CategoryName $name,
    ) {
    }
}
