<?php

declare(strict_types=1);

namespace App\Shared\Domain\Port;

use App\Shared\Domain\DomainEventInterface;

/**
 * Driven port for dispatching Domain Events.
 *
 * Defined in the Domain layer, implemented in the Infrastructure layer
 * (e.g. Symfony Messenger, in-memory bus for tests).
 *
 * @author Lionel KOUAME
 */
interface DomainEventBusInterface
{
    public function dispatch(DomainEventInterface ...$events): void;
}
