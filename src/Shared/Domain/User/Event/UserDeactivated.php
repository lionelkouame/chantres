<?php

declare(strict_types=1);

namespace App\Shared\Domain\User\Event;

use App\Shared\Domain\DomainEventInterface;
use App\Shared\Domain\User\UserId;

/**
 * Domain Event raised when a User account is deactivated.
 *
 * Blocks access to the rehearsal schedule and member-only features.
 * An optional reason should document the administrative context
 * (e.g. "Absence without notice", "Membership fee unpaid").
 *
 * @author Lionel KOUAME
 */
readonly class UserDeactivated implements DomainEventInterface
{
    public function __construct(
        private UserId $userId,
        private ?string $reason = null,
        private \DateTimeImmutable $occurredOn = new \DateTimeImmutable(),
    ) {
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function reason(): ?string
    {
        return $this->reason;
    }

    public function occurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
