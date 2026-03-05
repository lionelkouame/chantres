<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Domain\Model\Arrangement;

use App\SongManagement\Domain\Model\Arrangement\ArrangementId;
use PHPUnit\Framework\TestCase;

final class ArrangementIdTest extends TestCase
{
    private const string VALID_UUID = '6ba7b810-9dad-11d1-80b4-00c04fd430ca';

    public function testCreatesFromValidUuid(): void
    {
        $id = ArrangementId::fromString(self::VALID_UUID);

        self::assertSame(self::VALID_UUID, $id->value());
    }

    public function testToString(): void
    {
        $id = ArrangementId::fromString(self::VALID_UUID);

        self::assertSame(self::VALID_UUID, (string) $id);
    }

    public function testEqualReturnsTrueForSameValue(): void
    {
        $a = ArrangementId::fromString(self::VALID_UUID);
        $b = ArrangementId::fromString(self::VALID_UUID);

        self::assertTrue($a->equal($b));
    }

    public function testEqualReturnsFalseForDifferentValue(): void
    {
        $a = ArrangementId::fromString(self::VALID_UUID);
        $b = ArrangementId::fromString('550e8400-e29b-41d4-a716-446655440000');

        self::assertFalse($a->equal($b));
    }

    public function testRejectsInvalidUuid(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        ArrangementId::fromString('not-a-uuid');
    }
}
