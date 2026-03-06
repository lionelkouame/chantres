<?php

declare(strict_types=1);

namespace App\Shared\Domain\User\Profile;

/**
 * Marker interface for all User profile typologies.
 *
 * Each implementation encapsulates the identity data specific to its type
 * (NaturalPerson, LegalPerson, Automate) while keeping the User aggregate
 * root type-agnostic.
 *
 * @author Lionel KOUAME
 */
interface UserProfileInterface
{
    /**
     * Returns a human-readable display name for the user.
     */
    public function displayName(): string;
}
