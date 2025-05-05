<?php

declare(strict_types=1);

namespace App\SongManagement\Category\Application\Command;

final readonly class CreateCategoryCommand
{
    public function __construct(
        public string $id,
        public string $name,
    ) {
    }
}
