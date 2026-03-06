<?php

declare(strict_types=1);

namespace App\Shared\Domain\User\Profile;

use App\Shared\Domain\FullName;

/**
 * Profile for a Natural Person (physical individual).
 *
 * @author Lionel KOUAME
 */
readonly class NaturalPerson implements UserProfileInterface
{
    public function __construct(
        private FullName $fullName,
    ) {
    }

    public static function create(FullName $fullName): self
    {
        return new self($fullName);
    }

    public function fullName(): FullName
    {
        return $this->fullName;
    }

    public function displayName(): string
    {
        return $this->fullName->value();
    }
}
