<?php

declare(strict_types=1);

namespace App\Shared\Domain;

final readonly class FullName
{
    public function __construct(
        public FirstName $firstName,
        public LastName $lastName,
    ) {
    }

    public function value(): string
    {
        return $this->firstName->value().' '.$this->lastName->value();
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
