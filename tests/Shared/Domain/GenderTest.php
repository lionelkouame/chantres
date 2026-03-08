<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain;

use App\Shared\Domain\Gender;
use PHPUnit\Framework\TestCase;

final class GenderTest extends TestCase
{
    public function testItHasExpectedCases(): void
    {
        self::assertSame('male', Gender::MALE->value);
        self::assertSame('female', Gender::FEMALE->value);
        self::assertSame('other', Gender::OTHER->value);
    }

    public function testItCanBeCreatedFromValue(): void
    {
        self::assertSame(Gender::MALE, Gender::from('male'));
        self::assertSame(Gender::FEMALE, Gender::from('female'));
        self::assertSame(Gender::OTHER, Gender::from('other'));
    }

    public function testItHasExactlyThreeCases(): void
    {
        self::assertCount(3, Gender::cases());
    }
}
