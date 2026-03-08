<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain;

use App\Shared\Domain\Email;
use PHPUnit\Framework\TestCase;

final class EmailTest extends TestCase
{
    public function testCreatesValidEmail(): void
    {
        $email = new Email('user@example.com');

        self::assertSame('user@example.com', $email->value());
        self::assertSame('user@example.com', (string) $email);
    }

    public function testNormalizesToLowercase(): void
    {
        $email = new Email('User@EXAMPLE.COM');

        self::assertSame('user@example.com', $email->value());
    }

    public function testTrimsWhitespace(): void
    {
        $email = new Email('  user@example.com  ');

        self::assertSame('user@example.com', $email->value());
    }

    public function testThrowsOnInvalidEmail(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new Email('not-an-email');
    }

    public function testThrowsOnEmptyString(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new Email('');
    }
}
