<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Domain\Model\Contributor;

use App\SongManagement\Domain\Model\Contributor\ContributorId;
use App\SongManagement\Domain\Model\Contributor\ContributorIdCollection;
use PHPUnit\Framework\TestCase;

final class ContributorIdCollectionTest extends TestCase
{
    private const string UUID_A = '6ba7b810-9dad-11d1-80b4-00c04fd430c8';
    private const string UUID_B = '6ba7b810-9dad-11d1-80b4-00c04fd430c9';

    public function testEmptyCollection(): void
    {
        $collection = new ContributorIdCollection();

        self::assertTrue($collection->isEmpty());
        self::assertSame(0, $collection->count());
        self::assertSame([], $collection->all());
    }

    public function testCollectionWithItems(): void
    {
        $a = ContributorId::fromString(self::UUID_A);
        $b = ContributorId::fromString(self::UUID_B);
        $collection = new ContributorIdCollection($a, $b);

        self::assertFalse($collection->isEmpty());
        self::assertSame(2, $collection->count());
        self::assertSame([$a, $b], $collection->all());
    }
}
