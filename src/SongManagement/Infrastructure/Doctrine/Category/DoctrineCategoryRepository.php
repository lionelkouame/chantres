<?php

namespace App\SongManagement\Infrastructure\Doctrine\Category;

use App\SongManagement\Domain\Category\Category;
use App\SongManagement\Domain\Category\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\SongManagement\Infrastructure\Doctrine\Category\CategoryEntity;

class DoctrineCategoryRepository implements CategoryRepository
{
    public function __construct(
        private  EntityManagerInterface $entityManager
    )
    {}

    public function save(Category $category): void
    {
        /** @var CategoryEntity $entity */
        $entity = CategoryMapper::domainToEntity($category);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function find(string $id): ?Category
    {
        $entity = $this->entityManager->find(CategoryEntity::class, $id);

        if (!$entity) {
            return null;
        }

        return CategoryMapper::entityToDomain($entity);
    }

}
