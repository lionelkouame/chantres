<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Domain\Model\Contributor;

use App\Shared\Domain\FirstName;
use App\Shared\Domain\FullName;
use App\Shared\Domain\LastName;
use App\SongManagement\Domain\Model\Contributor\Biography;
use App\SongManagement\Domain\Model\Contributor\Contributor;
use App\SongManagement\Domain\Model\Contributor\ContributorId;
use PHPUnit\Framework\TestCase;

final class ContributorTest extends TestCase
{
    private const string UUID = '6ba7b810-9dad-11d1-80b4-00c04fd430c8';

    private function buildContributor(?Biography $biography = null): Contributor
    {
        return Contributor::register(
            ContributorId::fromString(self::UUID),
            new FullName(new FirstName('John'), new LastName('Doe')),
            $biography,
        );
    }

    public function testItExposesId(): void
    {
        $contributor = $this->buildContributor();

        self::assertSame(self::UUID, $contributor->contributorId()->value());
    }

    public function testItExposesFullName(): void
    {
        $contributor = $this->buildContributor();

        self::assertSame('John Doe', $contributor->fullName()->value());
    }

    public function testItExposesNullBiographyByDefault(): void
    {
        $contributor = $this->buildContributor();

        self::assertNull($contributor->biography());
    }

    public function testItExposesBiography(): void
    {
        $bio = new Biography('Compositeur du XIXe siècle.');
        $contributor = $this->buildContributor($bio);

        self::assertSame($bio, $contributor->biography());
    }
}
