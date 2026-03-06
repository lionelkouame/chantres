<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain\User;

use App\Shared\Domain\FirstName;
use App\Shared\Domain\FullName;
use App\Shared\Domain\LastName;
use App\Shared\Domain\Name;
use App\Shared\Domain\User\Profile\Automate;
use App\Shared\Domain\User\Profile\LegalPerson;
use App\Shared\Domain\User\Profile\NaturalPerson;
use App\Shared\Domain\User\User;
use App\Shared\Domain\User\UserId;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    private const string USER_UUID = '550e8400-e29b-41d4-a716-446655440000';

    private function userId(): UserId
    {
        return UserId::fromString(self::USER_UUID);
    }

    public function testCreatesNaturalPersonUser(): void
    {
        $profile = NaturalPerson::create(new FullName(new FirstName('Jean'), new LastName('Dupont')));
        $user = User::create($this->userId(), $profile);

        self::assertInstanceOf(User::class, $user);
        self::assertSame(self::USER_UUID, $user->userId()->value());
        self::assertInstanceOf(NaturalPerson::class, $user->profile());
        self::assertSame('Jean Dupont', $user->profile()->displayName());
    }

    public function testCreatesLegalPersonUser(): void
    {
        $profile = LegalPerson::create(new Name('Chorale Saint-Michel'));
        $user = User::create($this->userId(), $profile);

        self::assertInstanceOf(LegalPerson::class, $user->profile());
        self::assertSame('Chorale Saint-Michel', $user->profile()->displayName());
    }

    public function testCreatesAutomateUser(): void
    {
        $profile = Automate::create(new Name('ImportBot'));
        $user = User::create($this->userId(), $profile);

        self::assertInstanceOf(Automate::class, $user->profile());
        self::assertSame('ImportBot', $user->profile()->displayName());
    }

    public function testNaturalPersonExposesFullName(): void
    {
        $fullName = new FullName(new FirstName('Marie'), new LastName('Curie'));
        $profile = NaturalPerson::create($fullName);

        self::assertSame($fullName, $profile->fullName());
    }

    public function testLegalPersonExposesCorporateName(): void
    {
        $name = new Name('Association Musique & Foi');
        $profile = LegalPerson::create($name);

        self::assertSame($name, $profile->corporateName());
    }

    public function testAutomateExposesServiceName(): void
    {
        $name = new Name('SyncService');
        $profile = Automate::create($name);

        self::assertSame($name, $profile->serviceName());
    }
}
