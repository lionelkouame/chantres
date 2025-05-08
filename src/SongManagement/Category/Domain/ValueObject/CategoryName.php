<?php

// src/SongManagement/Domain/Category/ValueObject/CategoryName.php

declare(strict_types=1);

namespace App\SongManagement\Category\Domain\ValueObject;

class CategoryName
{
    private string $value;

    public function __construct(string $value)
    {
        if ('' === $value) {
            throw new \InvalidArgumentException('Category name cannot be empty');
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
