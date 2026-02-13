<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Domain\Category\ValueObject;

use App\SongManagement\Category\Domain\ValueObject\CategoryId;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class CategoryIdTest extends TestCase
{
    public function testItCanBeCreatedFromValidUuid(): void
    {
        $categoryId = CategoryId::generate();

        $uuid = Uuid::fromString($categoryId->getValue());

        $this->assertSame($categoryId->getValue(), $uuid->toString());
    }

    public function testItCanBeCreatedFromInvalidUuid(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new CategoryId('invalid-uuid');
    }
}
