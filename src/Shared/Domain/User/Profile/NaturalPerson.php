<?php

declare(strict_types=1);

namespace App\Shared\Domain\User\Profile;

use App\Shared\Domain\FullName;
use App\Shared\Domain\Gender;

/**
 * Profile for a Natural Person (physical individual).
 *
 * @author Lionel KOUAME
 */
readonly class NaturalPerson implements UserProfileInterface
{
    public function __construct(
        private FullName $fullName,
        private ?Gender $gender = null,
    ) {
    }

    public static function create(FullName $fullName, ?Gender $gender = null): self
    {
        return new self($fullName, $gender);
    }

    public function fullName(): FullName
    {
        return $this->fullName;
    }

    public function gender(): ?Gender
    {
        return $this->gender;
    }

    public function displayName(): string
    {
        return $this->fullName->value();
    }
}
