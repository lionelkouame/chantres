<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain;

use App\Shared\Domain\Email;
use PHPUnit\Framework\TestCase;

final class EmailTest extends TestCase
{
    public function testItReturnsTheEmailValue(): void
    {
        $email = new Email('John.Doe@Example.COM');
        self::assertSame('john.doe@example.com', $email->value());
        self::assertSame('john.doe@example.com', (string) $email);
    }

    public function testItNormalizesEmailToLowercase(): void
    {
        $email = new Email('UPPER@CASE.FR');
        self::assertSame('upper@case.fr', $email->value());
    }

    public function testItTrimsWhitespace(): void
    {
        $email = new Email('  user@example.com  ');
        self::assertSame('user@example.com', $email->value());
    }

    public function testItThrowsOnInvalidEmail(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Email('not-an-email');
    }

    public function testItThrowsOnEmptyString(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Email('');
    }
}
