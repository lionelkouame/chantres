<?php

declare(strict_types=1);

namespace App\Shared\Domain\User\Profile;

use App\Shared\Domain\Name;

/**
 * Profile for a Legal Person (company, association, organization).
 *
 * @author Lionel KOUAME
 */
readonly class LegalPerson implements UserProfileInterface
{
    public function __construct(
        private Name $corporateName,
    ) {
    }

    public static function create(Name $corporateName): self
    {
        return new self($corporateName);
    }

    public function corporateName(): Name
    {
        return $this->corporateName;
    }

    public function displayName(): string
    {
        return $this->corporateName->value();
    }
}
