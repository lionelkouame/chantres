<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain\User\Event;

use App\Shared\Domain\Email;
use App\Shared\Domain\Name;
use App\Shared\Domain\User\Event\UserRegistered;
use App\Shared\Domain\User\UserId;
use PHPUnit\Framework\TestCase;

final class UserRegisteredTest extends TestCase
{
    private const string USER_UUID = '550e8400-e29b-41d4-a716-446655440000';

    public function testCarriesExpectedPayload(): void
    {
        $userId = UserId::fromString(self::USER_UUID);
        $email  = new Email('jean.dupont@chorale.fr');
        $name   = new Name('Jean Dupont');

        $event = new UserRegistered($userId, $email, $name);

        self::assertSame($userId, $event->userId());
        self::assertSame($email, $event->email());
        self::assertSame($name, $event->name());
        self::assertInstanceOf(\DateTimeImmutable::class, $event->occurredOn());
    }

    public function testOccurredOnDefaultsToNow(): void
    {
        $before = new \DateTimeImmutable();
        $event  = new UserRegistered(
            UserId::fromString(self::USER_UUID),
            new Email('jean.dupont@chorale.fr'),
            new Name('Jean Dupont'),
        );
        $after = new \DateTimeImmutable();

        self::assertGreaterThanOrEqual($before, $event->occurredOn());
        self::assertLessThanOrEqual($after, $event->occurredOn());
    }

    public function testAcceptsExplicitOccurredOn(): void
    {
        $occurredOn = new \DateTimeImmutable('2026-01-15 10:00:00');
        $event      = new UserRegistered(
            UserId::fromString(self::USER_UUID),
            new Email('marie@chorale.fr'),
            new Name('Marie Curie'),
            $occurredOn,
        );

        self::assertSame($occurredOn, $event->occurredOn());
    }
}
