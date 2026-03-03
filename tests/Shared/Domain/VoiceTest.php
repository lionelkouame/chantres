<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain;

use App\Shared\Domain\Voice;
use PHPUnit\Framework\TestCase;

final class VoiceTest extends TestCase
{
    public function testItHasExpectedCases(): void
    {
        self::assertSame('soprano', Voice::SOPRANO->value);
        self::assertSame('alto', Voice::ALTO->value);
        self::assertSame('tenor', Voice::TENOR->value);
        self::assertSame('bass', Voice::BASS->value);
        self::assertSame('baritone', Voice::BAROTONE->value);
    }

    public function testItCanBeCreatedFromValue(): void
    {
        self::assertSame(Voice::TENOR, Voice::from('tenor'));
    }
}
