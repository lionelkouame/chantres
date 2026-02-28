<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Domain\Model\Contributor;

use App\SongManagement\Domain\Model\Contributor\ContributorId;
use PHPUnit\Framework\TestCase;

final class ContributorIdTest extends TestCase
{
    private const VALID_UUID = '550e8400-e29b-41d4-a716-446655440000';
    private const ANOTHER_VALID_UUID = '6ba7b810-9dad-11d1-80b4-00c04fd430c8';

    public function testcreatesFromValidUuid(): void
    {
        $contributorId = ContributorId::fromString(self::VALID_UUID);

        self::assertInstanceOf(ContributorId::class, $contributorId);
    }

    public function testreturnsTheUuidValue(): void
    {
        $contributorId = ContributorId::fromString(self::VALID_UUID);

        self::assertSame(self::VALID_UUID, $contributorId->value());
    }

    public function testconvertsToStringWithMagicMethod(): void
    {
        $contributorId = ContributorId::fromString(self::VALID_UUID);

        self::assertSame(self::VALID_UUID, (string) $contributorId);
    }

    public function testidentifiesEqualUuids(): void
    {
        $contributorId1 = ContributorId::fromString(self::VALID_UUID);
        $contributorId2 = ContributorId::fromString(self::VALID_UUID);

        self::assertTrue($contributorId1->equal($contributorId2));
    }

    public function testidentifiesDifferentUuids(): void
    {
        $contributorId1 = ContributorId::fromString(self::VALID_UUID);
        $contributorId2 = ContributorId::fromString(self::ANOTHER_VALID_UUID);

        self::assertFalse($contributorId1->equal($contributorId2));
    }

    public function testthrowsExceptionForInvalidFormat(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('is not a valid UUID');

        ContributorId::fromString('not-a-valid-uuid');
    }

    public function testthrowsExceptionForInvalidVersion(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('is not a valid UUID');

        ContributorId::fromString('550e8400-e29b-61d4-a716-446655440000');
    }

    public function testthrowsExceptionForInvalidVariant(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('is not a valid UUID');

        ContributorId::fromString('550e8400-e29b-41d4-f716-446655440000');
    }

    public function testacceptsValidUuidVersion1(): void
    {
        $uuidV1 = '6ba7b811-9dad-11d1-80b4-00c04fd430c8';
        $contributorId = ContributorId::fromString($uuidV1);

        self::assertSame($uuidV1, $contributorId->value());
    }

    public function testacceptsValidUuidVersion2(): void
    {
        $uuidV2 = '6ba7b812-9dad-21d1-80b4-00c04fd430c8';
        $contributorId = ContributorId::fromString($uuidV2);

        self::assertSame($uuidV2, $contributorId->value());
    }

    public function testacceptsValidUuidVersion3(): void
    {
        $uuidV3 = '6ba7b813-9dad-31d1-80b4-00c04fd430c8';
        $contributorId = ContributorId::fromString($uuidV3);

        self::assertSame($uuidV3, $contributorId->value());
    }

    public function testacceptsValidUuidVersion4(): void
    {
        $uuidV4 = '6ba7b814-9dad-41d1-80b4-00c04fd430c8';
        $contributorId = ContributorId::fromString($uuidV4);

        self::assertSame($uuidV4, $contributorId->value());
    }

    public function testacceptsValidUuidVersion5(): void
    {
        $uuidV5 = '6ba7b815-9dad-51d1-80b4-00c04fd430c8';
        $contributorId = ContributorId::fromString($uuidV5);

        self::assertSame($uuidV5, $contributorId->value());
    }

    public function testacceptsUppercaseUuid(): void
    {
        $uuidUppercase = '550E8400-E29B-41D4-A716-446655440000';
        $contributorId = ContributorId::fromString($uuidUppercase);

        self::assertSame($uuidUppercase, $contributorId->value());
    }

    public function testacceptsMixedCaseUuid(): void
    {
        $uuidMixed = '550e8400-E29B-41d4-A716-446655440000';
        $contributorId = ContributorId::fromString($uuidMixed);

        self::assertSame($uuidMixed, $contributorId->value());
    }

    public function testthrowsExceptionForEmptyString(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('is not a valid UUID');

        ContributorId::fromString('');
    }

    public function testthrowsExceptionForMissingHyphens(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('is not a valid UUID');

        ContributorId::fromString('550e8400e29b41d4a716446655440000');
    }

    public function testthrowsExceptionForUuidWithoutProperVariantBits(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('is not a valid UUID');

        ContributorId::fromString('550e8400-e29b-41d4-1716-446655440000');
    }

    public function testthrowsExceptionForUuidWithInvalidCharacters(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('is not a valid UUID');

        ContributorId::fromString('550e8400-e29b-41d4-a716-44665544000g');
    }

    public function testthrowsExceptionForTooShortUuid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('is not a valid UUID');

        ContributorId::fromString('550e8400-e29b-41d4-a716');
    }

    public function testthrowsExceptionForTooLongUuid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('is not a valid UUID');

        ContributorId::fromString('550e8400-e29b-41d4-a716-446655440000-extra');
    }
}
