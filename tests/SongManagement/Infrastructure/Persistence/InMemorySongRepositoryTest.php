<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Infrastructure\Persistence;

use App\SongManagement\Domain\Model\Arrangement\ArrangementCollection;
use App\SongManagement\Domain\Model\Contributor\ContributorId;
use App\SongManagement\Domain\Model\Song\Song;
use App\SongManagement\Domain\Model\Song\SongId;
use App\SongManagement\Domain\Model\Song\Title;
use App\SongManagement\Infrastructure\Persistence\InMemorySongRepository;
use PHPUnit\Framework\TestCase;

final class InMemorySongRepositoryTest extends TestCase
{
    private const string SONG_UUID = '550e8400-e29b-41d4-a716-446655440000';
    private const string COMPOSER_UUID = '6ba7b810-9dad-11d1-80b4-00c04fd430c8';
    private const string LYRICIST_UUID = '6ba7b810-9dad-11d1-80b4-00c04fd430c9';

    private function buildSong(string $uuid = self::SONG_UUID): Song
    {
        return Song::create(
            SongId::fromString($uuid),
            new Title('Amazing Grace'),
            ContributorId::fromString(self::COMPOSER_UUID),
            ContributorId::fromString(self::LYRICIST_UUID),
            new ArrangementCollection(),
        );
    }

    public function testItSavesAndFindsById(): void
    {
        $repo = new InMemorySongRepository();
        $song = $this->buildSong();

        $repo->save($song);

        self::assertSame($song, $repo->findById(SongId::fromString(self::SONG_UUID)));
    }

    public function testItReturnsNullWhenNotFound(): void
    {
        $repo = new InMemorySongRepository();

        self::assertNull($repo->findById(SongId::fromString(self::SONG_UUID)));
    }

    public function testFindAllReturnsAllSavedSongs(): void
    {
        $repo = new InMemorySongRepository();
        $a = $this->buildSong('550e8400-e29b-41d4-a716-446655440000');
        $b = $this->buildSong('6ba7b810-9dad-11d1-80b4-00c04fd430c8');

        $repo->save($a);
        $repo->save($b);

        self::assertCount(2, $repo->findAll());
    }

    public function testItDeletesSong(): void
    {
        $repo = new InMemorySongRepository();
        $song = $this->buildSong();

        $repo->save($song);
        $repo->delete(SongId::fromString(self::SONG_UUID));

        self::assertNull($repo->findById(SongId::fromString(self::SONG_UUID)));
    }
}
