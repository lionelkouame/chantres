<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Category\Repository;

interface CategoryRepository
{
    public function save(): void;
}
