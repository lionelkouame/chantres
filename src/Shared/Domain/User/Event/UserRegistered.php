<?php

declare(strict_types=1);

namespace App\Shared\Domain\User\Event;

use App\Shared\Domain\DomainEventInterface;
use App\Shared\Domain\Email;
use App\Shared\Domain\Name;
use App\Shared\Domain\User\UserId;

/**
 * Domain Event raised when a new User registers in the system.
 *
 * Carries the minimal identity data needed by downstream contexts to react:
 * send a welcome email, notify the administrator, create a default member profile.
 *
 * Note: $name holds the display name at the moment of registration
 * (e.g. full name for a NaturalPerson, corporate name for a LegalPerson).
 *
 * @author Lionel KOUAME
 */
readonly class UserRegistered implements DomainEventInterface
{
    public function __construct(
        private UserId $userId,
        private Email $email,
        private Name $name,
        private \DateTimeImmutable $occurredOn = new \DateTimeImmutable(),
    ) {
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function occurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
