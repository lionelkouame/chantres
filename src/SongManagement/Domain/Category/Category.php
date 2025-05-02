<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Category;

use App\Shared\Domain\ValueObject\CreatedAt;
use App\Shared\Domain\ValueObject\UpdatedAt;
use App\SongManagement\Domain\Category\Event\CategoryCreated;
use App\SongManagement\Domain\Category\Event\CategoryEventInterface;
use App\SongManagement\Domain\Category\ValueObject\CategoryId;
use App\SongManagement\Domain\Category\ValueObject\CategoryName;

final class Category
{
    /**
     * @var array<CategoryEventInterface>
     */
    private array $recordedEvents = [];

    public function __construct(
        private readonly CategoryId $id,
        private readonly CategoryName $name,
        private ?CreatedAt $createdAt = null,
        private ?UpdatedAt $updatedAt = null,
    ) {
    }

    public static function create(CategoryId $id, CategoryName $name, ?CreatedAt $createdAt = null): self
    {
        $category = new self($id, $name);
        $category->createdAt = $createdAt ?? CreatedAt::now();
        $category->updatedAt = UpdatedAt::now();

        $category->recordEvent(new CategoryCreated($id, $name, $createdAt));

        return $category;
    }

    /**
     * @return CategoryEventInterface[]
     */
    public function getRecordedEvents(): array
    {
        return $this->recordedEvents;
    }

    private function recordEvent(CategoryEventInterface $event): void
    {
        $this->recordedEvents[] = $event;
    }

    public function getId(): CategoryId
    {
        return $this->id;
    }

    public function getName(): CategoryName
    {
        return $this->name;
    }

    public function getCreatedAt(): ?CreatedAt
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?UpdatedAt
    {
        return $this->updatedAt;
    }
}
