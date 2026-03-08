<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain\User\Event;

use App\Shared\Domain\User\Event\UserArchived;
use App\Shared\Domain\User\UserId;
use PHPUnit\Framework\TestCase;

final class UserArchivedTest extends TestCase
{
    private const string USER_UUID = '550e8400-e29b-41d4-a716-446655440000';

    public function testCarriesUserId(): void
    {
        $userId = UserId::fromString(self::USER_UUID);
        $event = new UserArchived($userId);

        self::assertSame($userId, $event->userId());
        self::assertInstanceOf(\DateTimeImmutable::class, $event->occurredOn());
    }

    public function testAcceptsExplicitOccurredOn(): void
    {
        $occurredOn = new \DateTimeImmutable('2026-03-01 00:00:00');
        $event = new UserArchived(UserId::fromString(self::USER_UUID), $occurredOn);

        self::assertSame($occurredOn, $event->occurredOn());
    }
}
