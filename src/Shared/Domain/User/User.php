<?php

declare(strict_types=1);

namespace App\Shared\Domain\User;

use App\Shared\Domain\User\Profile\UserProfileInterface;

/**
 * Aggregate Root representing a User in the system.
 *
 * A User can be of three typologies, each encapsulated in its own profile:
 * - NaturalPerson  : a physical individual (FullName)
 * - LegalPerson    : a company or organisation (corporate Name)
 * - Automate       : a bot or automated service (service Name)
 *
 * The aggregate stays type-agnostic by delegating identity data to
 * the UserProfileInterface, avoiding conditional logic at this level.
 *
 * @author Lionel KOUAME
 */
readonly class User
{
    private function __construct(
        private UserId $userId,
        private UserProfileInterface $profile,
    ) {
    }

    public static function create(UserId $userId, UserProfileInterface $profile): self
    {
        return new self($userId, $profile);
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function profile(): UserProfileInterface
    {
        return $this->profile;
    }
}
