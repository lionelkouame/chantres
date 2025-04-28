<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Domain\Category;

use App\SongManagement\Domain\Category\Category;
use App\SongManagement\Domain\Category\ValueObject\CategoryId;
use App\SongManagement\Domain\Category\ValueObject\CategoryName;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testItCreatedCategoryAndRecordEvent(): void
    {
        $id = CategoryId::generate();
        $name = new CategoryName('MyCategoryJazz');

        $category = Category::create($id, $name);

        $this->assertSame($id, $category->getId());
        $this->assertSame($name, $category->getName());

        $this->assertCount(1, $category->getRecordedEvents());
    }
}
