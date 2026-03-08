<?php

declare(strict_types=1);

namespace App\Shared\Domain;

/**
 * Email Value Object.
 *
 * Validates RFC-compliant email addresses at construction time.
 *
 * @author Lionel KOUAME
 */
final readonly class Email
{
    private string $value;

    public function __construct(string $value)
    {
        $normalized = strtolower(trim($value));

        if (!filter_var($normalized, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(sprintf('The value "%s" is not a valid email address.', $value));
        }

        $this->value = $normalized;
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
