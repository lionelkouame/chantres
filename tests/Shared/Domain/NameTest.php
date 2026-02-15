<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain;

use App\Shared\Domain\Name;
use PHPUnit\Framework\TestCase;

final class NameTest extends TestCase
{
    public function testItReturnsTheNameValue(): void
    {
        $name = new Name('Test Name');
        self::assertSame('Test Name', $name->value);
        self::assertSame('Test Name', (string) $name);
    }
}
