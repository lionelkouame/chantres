<?php

declare(strict_types=1);

namespace App\SongManagement\Category\Application\Command;

use App\SongManagement\Category\Domain\ValueObject\CategoryId;
use App\SongManagement\Category\Domain\ValueObject\CategoryName;

readonly class CreateCategoryCommand
{
    public function __construct(
        public CategoryId $id,
        public CategoryName $name,
    ) {
    }
}
