<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Domain\Event;

use App\SongManagement\Domain\Event\ArrangementAddedToSong;
use App\SongManagement\Domain\Model\Arrangement\ArrangementId;
use App\SongManagement\Domain\Model\Song\SongId;
use PHPUnit\Framework\TestCase;

final class ArrangementAddedToSongTest extends TestCase
{
    private const string SONG_UUID = '550e8400-e29b-41d4-a716-446655440000';
    private const string ARRANGEMENT_UUID = '6ba7b810-9dad-11d1-80b4-00c04fd430ca';

    public function testItExposesProperties(): void
    {
        $songId = SongId::fromString(self::SONG_UUID);
        $arrangementId = ArrangementId::fromString(self::ARRANGEMENT_UUID);
        $occurredOn = new \DateTimeImmutable('2026-01-01 00:00:00');

        $event = new ArrangementAddedToSong($songId, $arrangementId, $occurredOn);

        self::assertSame($songId, $event->songId());
        self::assertSame($arrangementId, $event->arrangementId());
        self::assertSame($occurredOn, $event->occurredOn());
    }

    public function testItDefaultsOccurredOnToNow(): void
    {
        $before = new \DateTimeImmutable();
        $event = new ArrangementAddedToSong(
            SongId::fromString(self::SONG_UUID),
            ArrangementId::fromString(self::ARRANGEMENT_UUID),
        );
        $after = new \DateTimeImmutable();

        self::assertGreaterThanOrEqual($before, $event->occurredOn());
        self::assertLessThanOrEqual($after, $event->occurredOn());
    }
}
