<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Category\ValueObject;

use Symfony\Component\Uid\Uuid;

class CategoryId
{
    private Uuid $uuid;

    public function __construct(string $uuid)
    {
        try {
            $this->uuid = Uuid::fromString($uuid);
        } catch (\InvalidArgumentException $exception) {
            throw new \InvalidArgumentException("Invalid UUID: $uuid $exception");
        }
    }

    public static function generate(): self
    {
        $uuid = Uuid::v4()->toRfc4122();

        return new self($uuid);
    }

    public function getValue(): string
    {
        return $this->uuid->toRfc4122();
    }

    public function equals(CategoryId $other): bool
    {
        return $this->uuid->equals($other->uuid);
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
