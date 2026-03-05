<?php

declare(strict_types=1);

namespace App\Shared\Domain;

/**
 * Marker interface for all Domain Events.
 *
 * Domain Events are immutable records of something that happened in the domain.
 * They are raised by Aggregate Roots and dispatched by the Application layer.
 *
 * @author Lionel KOUAME
 */
interface DomainEventInterface
{
    public function occurredOn(): \DateTimeImmutable;
}
