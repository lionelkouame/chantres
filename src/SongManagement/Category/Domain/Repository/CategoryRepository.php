<?php

declare(strict_types=1);

namespace App\SongManagement\Category\Domain\Repository;

use App\SongManagement\Category\Domain\Category;

interface CategoryRepository
{
    public function save(Category $category): void;
}
