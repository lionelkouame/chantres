<?php

declare(strict_types=1);

namespace App\SongManagement\Application\Category\Command;

final readonly class CreateCategoryCommand
{
    public function __construct(
        public string $name,
        public string $id,
    ) {
    }
}
