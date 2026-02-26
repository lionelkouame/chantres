<?php

namespace App\Shared;

trait StringValueObjectInterface
{
    public function __construct(public readonly string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
