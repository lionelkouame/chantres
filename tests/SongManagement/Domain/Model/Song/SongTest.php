<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Domain\Model\Song;

use App\SongManagement\Domain\Model\Arrangement\Arrangement;
use App\SongManagement\Domain\Model\Arrangement\ArrangementCollection;
use App\SongManagement\Domain\Model\Arrangement\ArrangementId;
use App\SongManagement\Domain\Model\Contributor\ContributorId;
use App\SongManagement\Domain\Model\Song\Song;
use App\SongManagement\Domain\Model\Song\SongId;
use App\SongManagement\Domain\Model\Song\Title;
use PHPUnit\Framework\TestCase;

final class SongTest extends TestCase
{
    private const string SONG_UUID = '550e8400-e29b-41d4-a716-446655440000';
    private const string COMPOSER_UUID = '6ba7b810-9dad-11d1-80b4-00c04fd430c8';
    private const string LYRICIST_UUID = '6ba7b810-9dad-11d1-80b4-00c04fd430c9';
    private const string ARRANGEMENT_UUID = '6ba7b810-9dad-11d1-80b4-00c04fd430ca';

    private function buildSong(ArrangementCollection $arrangements): Song
    {
        return Song::create(
            SongId::fromString(self::SONG_UUID),
            new Title('Amazing Grace'),
            ContributorId::fromString(self::COMPOSER_UUID),
            ContributorId::fromString(self::LYRICIST_UUID),
            $arrangements,
        );
    }

    public function testCreatesWithNoArrangements(): void
    {
        $song = $this->buildSong(new ArrangementCollection());

        self::assertInstanceOf(Song::class, $song);
        self::assertTrue($song->arrangements()->isEmpty());
    }

    public function testCreatesWithOneArrangement(): void
    {
        $arrangement = Arrangement::create(ArrangementId::fromString(self::ARRANGEMENT_UUID));
        $song = $this->buildSong(new ArrangementCollection($arrangement));

        self::assertSame(1, $song->arrangements()->count());
    }

    public function testExposesComposerId(): void
    {
        $song = $this->buildSong(new ArrangementCollection());

        self::assertSame(self::COMPOSER_UUID, $song->composerId()->value());
    }

    public function testExposesLyricistId(): void
    {
        $song = $this->buildSong(new ArrangementCollection());

        self::assertSame(self::LYRICIST_UUID, $song->lyricistId()->value());
    }

    public function testExposesArrangements(): void
    {
        $arrangement = Arrangement::create(ArrangementId::fromString(self::ARRANGEMENT_UUID));
        $song = $this->buildSong(new ArrangementCollection($arrangement));

        self::assertSame([$arrangement], $song->arrangements()->all());
    }
}
