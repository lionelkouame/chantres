<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Api\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Shared\Infrastructure\Api\Resource\StatusResource;

/**
 * @implements ProviderInterface<StatusResource>
 *
 * @author Lionel KOUAME
 */
final class StatusProvider implements ProviderInterface
{
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): StatusResource
    {
        return new StatusResource(
            status: 'ok',
            version: '1.0.0',
            timestamp: new \DateTimeImmutable(),
        );
    }
}
