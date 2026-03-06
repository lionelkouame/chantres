<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain;

use App\Shared\Domain\FirstName;
use App\Shared\Domain\FullName;
use App\Shared\Domain\LastName;
use PHPUnit\Framework\TestCase;

final class FullNameTest extends TestCase
{
    private FullName $fullName;

    protected function setUp(): void
    {
        $this->fullName = new FullName(new FirstName('John'), new LastName('Doe'));
    }

    public function testValueConcatenatesFirstAndLastName(): void
    {
        self::assertSame('John Doe', $this->fullName->value());
    }

    public function testToStringReturnsFullName(): void
    {
        self::assertSame('John Doe', (string) $this->fullName);
    }

    public function testExposesFirstName(): void
    {
        self::assertSame('John', $this->fullName->firstName->value());
    }

    public function testExposesLastName(): void
    {
        self::assertSame('Doe', $this->fullName->lastName->value());
    }
}
