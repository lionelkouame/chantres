<?php

declare(strict_types=1);

namespace App\Shared\Domain;

final readonly class Name
{
    public function __construct(public string $value)
    {
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
