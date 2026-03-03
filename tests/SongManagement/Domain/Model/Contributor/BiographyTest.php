<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Domain\Model\Contributor;

use App\SongManagement\Domain\Model\Contributor\Biography;
use PHPUnit\Framework\TestCase;

final class BiographyTest extends TestCase
{
    public function testcreatesFromString(): void
    {
        $biography = new Biography('A talented musician.');

        self::assertInstanceOf(Biography::class, $biography);
    }

    public function testreturnsTheValue(): void
    {
        $biography = new Biography('A talented musician.');

        self::assertSame('A talented musician.', $biography->value());
    }

    public function testconvertsToStringWithMagicMethod(): void
    {
        $biography = new Biography('A talented musician.');

        self::assertSame('A talented musician.', (string) $biography);
    }

    public function testacceptsEmptyString(): void
    {
        $biography = new Biography('');

        self::assertSame('', $biography->value());
    }
}
