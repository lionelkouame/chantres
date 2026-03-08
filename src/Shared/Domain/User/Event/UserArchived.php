<?php

declare(strict_types=1);

namespace App\Shared\Domain\User\Event;

use App\Shared\Domain\DomainEventInterface;
use App\Shared\Domain\User\UserId;

/**
 * Domain Event raised when a User account is archived (soft-deletion).
 *
 * Preferred over physical deletion to preserve audit trails.
 * Downstream contexts should remove the user from mailing lists
 * and anonymise personal data while retaining song history.
 *
 * @author Lionel KOUAME
 */
readonly class UserArchived implements DomainEventInterface
{
    public function __construct(
        private UserId $userId,
        private \DateTimeImmutable $occurredOn = new \DateTimeImmutable(),
    ) {
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function occurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
