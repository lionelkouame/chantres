<?php

namespace App\Shared\Domain\ValueObject;

final class UpdatedAt
{
    private \DateTimeImmutable $value;

    public function __construct(\DateTimeImmutable $value)
    {
        if ($value > new \DateTimeImmutable()) {
            throw new \InvalidArgumentException('UpdatedAt cannot be in the future.');
        }
        $this->value = $value;
    }

    public static function now(): self
    {
        return new self(new \DateTimeImmutable());
    }

    public function getValue(): \DateTimeImmutable
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value == $other->value;
    }

    public function __toString(): string
    {
        return $this->value->format(DATE_ATOM);
    }
}
