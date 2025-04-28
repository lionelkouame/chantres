<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Category;

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
    ) {
    }

    public static function create(CategoryId $id, CategoryName $name): self
    {
        $category = new self($id, $name);
        $category->recordEvent(new CategoryCreated($id, $name));

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
}
