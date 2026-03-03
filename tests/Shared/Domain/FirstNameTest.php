<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain;

use App\Shared\Domain\FirstName;
use PHPUnit\Framework\TestCase;

final class FirstNameTest extends TestCase
{
    public function testItReturnsTheFirstNameValue(): void
    {
        $firstName = new FirstName('John');
        self::assertSame('John', $firstName->value());
        self::assertSame('John', (string) $firstName);
    }
}
