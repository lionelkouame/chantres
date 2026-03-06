<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain\User\Profile;

use App\Shared\Domain\User\Profile\AutomateId;
use PHPUnit\Framework\TestCase;

final class AutomateIdTest extends TestCase
{
    private const string VALID_UUID = '550e8400-e29b-41d4-a716-446655440002';
    private const string ANOTHER_UUID = '6ba7b810-9dad-11d1-80b4-00c04fd430c8';

    public function testCreatesFromValidUuid(): void
    {
        $id = AutomateId::fromString(self::VALID_UUID);

        self::assertSame(self::VALID_UUID, $id->value());
    }

    public function testToString(): void
    {
        $id = AutomateId::fromString(self::VALID_UUID);

        self::assertSame(self::VALID_UUID, (string) $id);
    }

    public function testEqualReturnsTrueForSameValue(): void
    {
        $a = AutomateId::fromString(self::VALID_UUID);
        $b = AutomateId::fromString(self::VALID_UUID);

        self::assertTrue($a->equal($b));
    }

    public function testEqualReturnsFalseForDifferentValue(): void
    {
        $a = AutomateId::fromString(self::VALID_UUID);
        $b = AutomateId::fromString(self::ANOTHER_UUID);

        self::assertFalse($a->equal($b));
    }

    public function testRejectsInvalidUuid(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        AutomateId::fromString('not-a-uuid');
    }
}
