<?php

namespace App\SongManagement\Category\Domain\Event;

use App\Shared\Domain\ValueObject\CreatedAt;
use App\Shared\Domain\ValueObject\UpdatedAt;
use App\SongManagement\Category\Domain\Event\CategoryEventInterface;
use App\SongManagement\Category\Domain\ValueObject\CategoryId;
use App\SongManagement\Category\Domain\ValueObject\CategoryName;

final readonly class CategoryCreated implements CategoryEventInterface
{
    public function __construct(
        public CategoryId $id,
        public CategoryName $name,
        public ?CreatedAt $createdAt = null,
        public ?UpdatedAt $updatedAt = null,
    ) {
    }
}
