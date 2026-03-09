<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Api\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\Shared\Infrastructure\Api\State\StatusProvider;

/**
 * Test endpoint – returns the current API status.
 *
 * @author Lionel KOUAME
 */
#[ApiResource(
    shortName: 'Status',
    operations: [
        new Get(
            uriTemplate: '/status',
            provider: StatusProvider::class,
        ),
    ],
)]
final class StatusResource
{
    public function __construct(
        public readonly string $status,
        public readonly string $version,
        public readonly \DateTimeImmutable $timestamp,
    ) {
    }
}
