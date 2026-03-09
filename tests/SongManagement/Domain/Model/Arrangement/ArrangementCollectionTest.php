<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Domain\Model\Arrangement;

use App\SongManagement\Domain\Model\Arrangement\Arrangement;
use App\SongManagement\Domain\Model\Arrangement\ArrangementCollection;
use App\SongManagement\Domain\Model\Arrangement\ArrangementId;
use PHPUnit\Framework\TestCase;

final class ArrangementCollectionTest extends TestCase
{
    private const string UUID_A = '6ba7b810-9dad-11d1-80b4-00c04fd430ca';
    private const string UUID_B = '550e8400-e29b-41d4-a716-446655440000';

    private function makeArrangement(string $uuid): Arrangement
    {
        return Arrangement::create(ArrangementId::fromString($uuid));
    }

    public function testEmptyCollectionIsEmpty(): void
    {
        $collection = new ArrangementCollection();

        self::assertTrue($collection->isEmpty());
        self::assertSame(0, $collection->count());
        self::assertSame([], $collection->all());
    }

    public function testCollectionWithItems(): void
    {
        $a = $this->makeArrangement(self::UUID_A);
        $b = $this->makeArrangement(self::UUID_B);
        $collection = new ArrangementCollection($a, $b);

        self::assertFalse($collection->isEmpty());
        self::assertSame(2, $collection->count());
        self::assertSame([$a, $b], $collection->all());
    }
}
