<?php

declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Api\State;

use ApiPlatform\Metadata\Get;
use App\Shared\Infrastructure\Api\Resource\StatusResource;
use App\Shared\Infrastructure\Api\State\StatusProvider;
use PHPUnit\Framework\TestCase;

final class StatusProviderTest extends TestCase
{
    public function testItReturnsOkStatus(): void
    {
        $provider = new StatusProvider();
        $result = $provider->provide(new Get());

        self::assertInstanceOf(StatusResource::class, $result);
        self::assertSame('ok', $result->status);
        self::assertSame('1.0.0', $result->version);
        self::assertInstanceOf(\DateTimeImmutable::class, $result->timestamp);
    }
}
