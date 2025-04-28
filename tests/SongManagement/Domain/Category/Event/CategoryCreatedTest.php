<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Domain\Category\Event;

use App\SongManagement\Domain\Category\Event\CategoryCreated;
use App\SongManagement\Domain\Category\ValueObject\CategoryId;
use App\SongManagement\Domain\Category\ValueObject\CategoryName;
use PHPUnit\Framework\TestCase;

class CategoryCreatedTest extends TestCase
{
    public function testItHoldsNameAndId(): void
    {
        $name = new CategoryName('HelloCat');
        $id = CategoryId::generate();

        $category = new CategoryCreated($id, $name);

        $this->assertSame($category->id, $id);
        $this->assertSame($category->name, $name);
    }
}
