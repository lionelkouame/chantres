<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain\User\Profile;

use App\Shared\Domain\User\Profile\NaturalPersonId;
use PHPUnit\Framework\TestCase;

final class NaturalPersonIdTest extends TestCase
{
    private const string VALID_UUID = '550e8400-e29b-41d4-a716-446655440000';
    private const string ANOTHER_UUID = '6ba7b810-9dad-11d1-80b4-00c04fd430c8';

    public function testCreatesFromValidUuid(): void
    {
        $id = NaturalPersonId::fromString(self::VALID_UUID);

        self::assertSame(self::VALID_UUID, $id->value());
    }

    public function testToString(): void
    {
        $id = NaturalPersonId::fromString(self::VALID_UUID);

        self::assertSame(self::VALID_UUID, (string) $id);
    }

    public function testEqualReturnsTrueForSameValue(): void
    {
        $a = NaturalPersonId::fromString(self::VALID_UUID);
        $b = NaturalPersonId::fromString(self::VALID_UUID);

        self::assertTrue($a->equal($b));
    }

    public function testEqualReturnsFalseForDifferentValue(): void
    {
        $a = NaturalPersonId::fromString(self::VALID_UUID);
        $b = NaturalPersonId::fromString(self::ANOTHER_UUID);

        self::assertFalse($a->equal($b));
    }

    public function testRejectsInvalidUuid(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        NaturalPersonId::fromString('not-a-uuid');
    }
}
