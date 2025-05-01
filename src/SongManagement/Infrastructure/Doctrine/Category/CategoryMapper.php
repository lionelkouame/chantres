<?php

namespace App\SongManagement\Infrastructure\Doctrine\Category;

use App\SongManagement\Domain\Category\Category;
use App\SongManagement\Domain\Category\ValueObject\CategoryId;
use App\SongManagement\Domain\Category\ValueObject\CategoryName;

final class CategoryMapper
{
    public static function domainToEntity(Category $category): CategoryEntity
    {
        return new CategoryEntity(
            $category->getId(),
            $category->getName(),
        );
    }

    public static function entityToDomain(CategoryEntity $categoryEntity): Category
    {
        $id = new CategoryId($categoryEntity->getId());
        $name = new CategoryName($categoryEntity->getName());

        return new Category($id, $name);
    }
}
