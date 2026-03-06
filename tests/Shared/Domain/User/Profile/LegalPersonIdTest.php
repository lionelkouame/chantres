<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain\User\Profile;

use App\Shared\Domain\User\Profile\LegalPersonId;
use PHPUnit\Framework\TestCase;

final class LegalPersonIdTest extends TestCase
{
    private const string VALID_UUID = '550e8400-e29b-41d4-a716-446655440001';
    private const string ANOTHER_UUID = '6ba7b810-9dad-11d1-80b4-00c04fd430c8';

    public function testCreatesFromValidUuid(): void
    {
        $id = LegalPersonId::fromString(self::VALID_UUID);

        self::assertSame(self::VALID_UUID, $id->value());
    }

    public function testToString(): void
    {
        $id = LegalPersonId::fromString(self::VALID_UUID);

        self::assertSame(self::VALID_UUID, (string) $id);
    }

    public function testEqualReturnsTrueForSameValue(): void
    {
        $a = LegalPersonId::fromString(self::VALID_UUID);
        $b = LegalPersonId::fromString(self::VALID_UUID);

        self::assertTrue($a->equal($b));
    }

    public function testEqualReturnsFalseForDifferentValue(): void
    {
        $a = LegalPersonId::fromString(self::VALID_UUID);
        $b = LegalPersonId::fromString(self::ANOTHER_UUID);

        self::assertFalse($a->equal($b));
    }

    public function testRejectsInvalidUuid(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        LegalPersonId::fromString('not-a-uuid');
    }
}
