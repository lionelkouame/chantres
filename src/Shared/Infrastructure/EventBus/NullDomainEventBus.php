<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\EventBus;

use App\Shared\Domain\DomainEventInterface;
use App\Shared\Domain\Port\DomainEventBusInterface;

/**
 * No-op event bus – development/test stub.
 *
 * Replace with a Symfony Messenger-backed implementation for production.
 *
 * @author Lionel KOUAME
 */
final class NullDomainEventBus implements DomainEventBusInterface
{
    public function dispatch(DomainEventInterface ...$events): void
    {
        // intentionally no-op
    }
}
