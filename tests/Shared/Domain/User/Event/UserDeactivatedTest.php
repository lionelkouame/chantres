<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain\User\Event;

use App\Shared\Domain\User\Event\UserDeactivated;
use App\Shared\Domain\User\UserId;
use PHPUnit\Framework\TestCase;

final class UserDeactivatedTest extends TestCase
{
    private const string USER_UUID = '550e8400-e29b-41d4-a716-446655440000';

    public function testCarriesUserIdAndNullReasonByDefault(): void
    {
        $userId = UserId::fromString(self::USER_UUID);
        $event  = new UserDeactivated($userId);

        self::assertSame($userId, $event->userId());
        self::assertNull($event->reason());
        self::assertInstanceOf(\DateTimeImmutable::class, $event->occurredOn());
    }

    public function testCarriesOptionalReason(): void
    {
        $event = new UserDeactivated(
            UserId::fromString(self::USER_UUID),
            'Cotisation impayée',
        );

        self::assertSame('Cotisation impayée', $event->reason());
    }
}
