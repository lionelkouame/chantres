<?php

namespace App\SongManagement\Category\Infrastructure\Doctrine\Category;

use App\SongManagement\Category\Domain\Category;
use App\SongManagement\Category\Domain\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineCategoryRepository implements CategoryRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

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

        if (null === $entity) {
            return null;
        }

        return CategoryMapper::entityToDomain($entity);
    }
}
