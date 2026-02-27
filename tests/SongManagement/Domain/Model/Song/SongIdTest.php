<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Domain\Model\Song;

use App\SongManagement\Domain\Model\Song\SongId;
use PHPUnit\Framework\TestCase;

final class SongIdTest extends TestCase
{
    private const string VALID_UUID = '550e8400-e29b-41d4-a716-446655440000';
    private const string ANOTHER_VALID_UUID = '6ba7b810-9dad-11d1-80b4-00c04fd430c8';

    public function testcreatesFromValidUuid(): void
    {
        $songId = SongId::fromString(self::VALID_UUID);

        self::assertInstanceOf(SongId::class, $songId);
    }

    public function testreturnsTheUuidValue(): void
    {
        $songId = SongId::fromString(self::VALID_UUID);

        self::assertSame(self::VALID_UUID, $songId->value());
    }

    public function testconvertsToStringWithMagicMethod(): void
    {
        $songId = SongId::fromString(self::VALID_UUID);

        self::assertSame(self::VALID_UUID, (string) $songId);
    }

    public function testidentifiesEqualUuids(): void
    {
        $songId1 = SongId::fromString(self::VALID_UUID);
        $songId2 = SongId::fromString(self::VALID_UUID);

        self::assertTrue($songId1->equal($songId2));
    }

    public function testidentifiesDifferentUuids(): void
    {
        $songId1 = SongId::fromString(self::VALID_UUID);
        $songId2 = SongId::fromString(self::ANOTHER_VALID_UUID);

        self::assertFalse($songId1->equal($songId2));
    }

    public function testthrowsExceptionForInvalidFormat(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('is not a valid UUID');

        SongId::fromString('not-a-valid-uuid');
    }

    public function testthrowsExceptionForInvalidVersion(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('is not a valid UUID');

        SongId::fromString('550e8400-e29b-61d4-a716-446655440000');
    }

    public function testthrowsExceptionForInvalidVariant(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('is not a valid UUID');

        SongId::fromString('550e8400-e29b-41d4-f716-446655440000');
    }

    public function testacceptsValidUuidVersion1(): void
    {
        $uuidV1 = '6ba7b811-9dad-11d1-80b4-00c04fd430c8';
        $songId = SongId::fromString($uuidV1);

        self::assertSame($uuidV1, $songId->value());
    }

    public function testacceptsValidUuidVersion2(): void
    {
        $uuidV2 = '6ba7b812-9dad-21d1-80b4-00c04fd430c8';
        $songId = SongId::fromString($uuidV2);

        self::assertSame($uuidV2, $songId->value());
    }

    public function testacceptsValidUuidVersion3(): void
    {
        $uuidV3 = '6ba7b813-9dad-31d1-80b4-00c04fd430c8';
        $songId = SongId::fromString($uuidV3);

        self::assertSame($uuidV3, $songId->value());
    }

    public function testacceptsValidUuidVersion4(): void
    {
        $uuidV4 = '6ba7b814-9dad-41d1-80b4-00c04fd430c8';
        $songId = SongId::fromString($uuidV4);

        self::assertSame($uuidV4, $songId->value());
    }

    public function acceptsValidUuidVersion5(): void
    {
        $uuidV5 = '6ba7b815-9dad-51d1-80b4-00c04fd430c8';
        $songId = SongId::fromString($uuidV5);

        self::assertSame($uuidV5, $songId->value());
    }

    public function acceptsUppercaseUuid(): void
    {
        $uuidUppercase = '550E8400-E29B-41D4-A716-446655440000';
        $songId = SongId::fromString($uuidUppercase);

        self::assertSame($uuidUppercase, $songId->value());
    }

    public function testacceptsMixedCaseUuid(): void
    {
        $uuidMixed = '550e8400-E29B-41d4-A716-446655440000';
        $songId = SongId::fromString($uuidMixed);

        self::assertSame($uuidMixed, $songId->value());
    }

    public function testthrowsExceptionForEmptyString(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('is not a valid UUID');

        SongId::fromString('');
    }

    public function testthrowsExceptionForMissingHyphens(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('is not a valid UUID');

        SongId::fromString('550e8400e29b41d4a716446655440000');
    }

    public function testthrowsExceptionForUuidWithoutProperVariantBits(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('is not a valid UUID');

        SongId::fromString('550e8400-e29b-41d4-1716-446655440000');
    }

    public function testthrowsExceptionForUuidWithInvalidCharacters(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('is not a valid UUID');

        SongId::fromString('550e8400-e29b-41d4-a716-44665544000g');
    }

    public function testthrowsExceptionForTooShortUuid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('is not a valid UUID');

        SongId::fromString('550e8400-e29b-41d4-a716');
    }

    public function testthrowsExceptionForTooLongUuid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('is not a valid UUID');

        SongId::fromString('550e8400-e29b-41d4-a716-446655440000-extra');
    }
}
