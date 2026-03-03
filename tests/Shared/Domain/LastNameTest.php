<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain;

use App\Shared\Domain\LastName;
use PHPUnit\Framework\TestCase;

final class LastNameTest extends TestCase
{
    public function testItReturnsTheLastNameValue(): void
    {
        $lastName = new LastName('Doe');
        self::assertSame('Doe', $lastName->value());
        self::assertSame('Doe', (string) $lastName);
    }
}
