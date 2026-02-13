<?php

namespace App\SongManagement\Category\Infrastructure\Doctrine\Category;

use App\Shared\Infrastructure\Doctrine\Mapper\CreatedAtMapper;
use App\Shared\Infrastructure\Doctrine\Mapper\UpdatedAtMapper;
use App\SongManagement\Category\Domain\Category;
use App\SongManagement\Category\Domain\ValueObject\CategoryId;
use App\SongManagement\Category\Domain\ValueObject\CategoryName;

final class CategoryMapper
{
    public static function domainToEntity(Category $category): CategoryEntity
    {
        return new CategoryEntity(
            $category->getId(),
            $category->getName(),
            CreatedAtMapper::toEmbeddable($category->getCreatedAt()),
            UpdatedAtMapper::toEmbeddable($category->getUpdatedAt()),
        );
    }

    public static function entityToDomain(CategoryEntity $categoryEntity): Category
    {
        $id = new CategoryId($categoryEntity->getId());
        $name = new CategoryName($categoryEntity->getName());
        $createdAt = CreatedAtMapper::toValueObject($categoryEntity->getCreatedAt());
        $updatedAt = UpdatedAtMapper::toValueObject($categoryEntity->getUpdatedAt());

        $category = Category::create($id, $name, $createdAt);
        $category->setUpdatedAt($updatedAt);

        return $category;
    }
}
