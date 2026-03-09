<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Domain\Event;

use App\SongManagement\Domain\Event\SongAddedToLibrary;
use App\SongManagement\Domain\Model\Contributor\ContributorId;
use App\SongManagement\Domain\Model\Contributor\ContributorIdCollection;
use App\SongManagement\Domain\Model\Song\SongId;
use PHPUnit\Framework\TestCase;

final class SongAddedToLibraryTest extends TestCase
{
    private const string SONG_UUID = '550e8400-e29b-41d4-a716-446655440000';
    private const string CONTRIBUTOR_UUID = '6ba7b810-9dad-11d1-80b4-00c04fd430c8';

    public function testItExposesProperties(): void
    {
        $songId = SongId::fromString(self::SONG_UUID);
        $collection = new ContributorIdCollection(ContributorId::fromString(self::CONTRIBUTOR_UUID));
        $occurredOn = new \DateTimeImmutable('2026-01-01 00:00:00');

        $event = new SongAddedToLibrary($songId, $collection, $occurredOn);

        self::assertSame($songId, $event->songId());
        self::assertSame($collection, $event->contributorIdList());
        self::assertSame($occurredOn, $event->occurredOn());
    }

    public function testItDefaultsOccurredOnToNow(): void
    {
        $before = new \DateTimeImmutable();
        $event = new SongAddedToLibrary(
            SongId::fromString(self::SONG_UUID),
            new ContributorIdCollection(),
        );
        $after = new \DateTimeImmutable();

        self::assertGreaterThanOrEqual($before, $event->occurredOn());
        self::assertLessThanOrEqual($after, $event->occurredOn());
    }
}
