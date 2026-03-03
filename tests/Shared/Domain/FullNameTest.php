<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain;

use App\Shared\Domain\FirstName;
use App\Shared\Domain\FullName;
use App\Shared\Domain\LastName;
use PHPUnit\Framework\TestCase;

final class FullNameTest extends TestCase
{
    public function testItReturnsTheFullNameValue(): void
    {
        $fullName = new FullName(new FirstName('John'), new LastName('Doe'));
        self::assertSame('John Doe', $fullName->value());
        self::assertSame('John Doe', (string) $fullName);
    }

    public function testItExposesFirstAndLastName(): void
    {
        $fullName = new FullName(new FirstName('John'), new LastName('Doe'));
        self::assertSame('John', $fullName->firstName->value());
        self::assertSame('Doe', $fullName->lastName->value());
    }
}
