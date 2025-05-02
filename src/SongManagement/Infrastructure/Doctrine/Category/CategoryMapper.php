<?php

namespace App\SongManagement\Infrastructure\Doctrine\Category;

use App\Shared\Infrastructure\Doctrine\Mapper\CreatedAtMapper;
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
            CreatedAtMapper::toEmbeddable($category->getCreatedAt()),
        );
    }

    public static function entityToDomain(CategoryEntity $categoryEntity): Category
    {
        $id = new CategoryId($categoryEntity->getId());
        $name = new CategoryName($categoryEntity->getName());
        $createdAt = $categoryEntity->getCreatedAt();

        return  Category::create($id, $name, $createdAt);
    }
}
