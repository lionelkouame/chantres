<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Model\Contributor;

/**
 * ContributorId Value Object.
 *
 * Pur Domain implementation with no framework dependencies.
 *
 * @author Lionel KOUAME
 */
readonly class ContributorId
{
    private const string UUID_PATTERN = '/^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i';

    private function __construct(
        private string $value,
    ) {
        $this->ensureIsValidUuid($this->value);
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equal(self $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function ensureIsValidUuid(string $value): void
    {
        if (!preg_match(self::UUID_PATTERN, $value)) {
            throw new \InvalidArgumentException(sprintf('The given value "%s" is not a valid UUID.', $value));
        }
    }
}
