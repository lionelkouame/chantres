<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Category\Repository;

use App\SongManagement\Domain\Category\Category;

interface CategoryRepository
{
    public function save(Category $category): void;
}
