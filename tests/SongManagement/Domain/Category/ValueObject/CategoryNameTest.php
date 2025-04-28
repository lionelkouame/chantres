<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Domain\Category\ValueObject;

use App\SongManagement\Domain\Category\ValueObject\CategoryName;
use PHPUnit\Framework\TestCase;

class CategoryNameTest extends TestCase
{
    public function testItCreateAValidCategoryName(): void
    {
        $name = new CategoryName('HelloCat');

        $this->assertSame('HelloCat', $name->getValue());
    }
}
