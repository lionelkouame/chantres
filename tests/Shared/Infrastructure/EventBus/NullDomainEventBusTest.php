<?php

declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\EventBus;

use App\Shared\Domain\DomainEventInterface;
use App\Shared\Infrastructure\EventBus\NullDomainEventBus;
use PHPUnit\Framework\TestCase;

final class NullDomainEventBusTest extends TestCase
{
    public function testItDispatchesWithoutError(): void
    {
        $bus = new NullDomainEventBus();
        $event = $this->createMock(DomainEventInterface::class);

        $bus->dispatch($event);
        $bus->dispatch($event, $event);

        $this->expectNotToPerformAssertions();
    }
}
