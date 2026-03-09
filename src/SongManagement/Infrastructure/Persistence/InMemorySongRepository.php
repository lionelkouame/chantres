<?php

declare(strict_types=1);

namespace App\SongManagement\Infrastructure\Persistence;

use App\SongManagement\Domain\Model\Song\Song;
use App\SongManagement\Domain\Model\Song\SongId;
use App\SongManagement\Domain\Port\SongCollection;

/**
 * In-memory Song repository – development/test stub.
 *
 * Replace with a Doctrine-backed implementation for production.
 *
 * @author Lionel KOUAME
 */
final class InMemorySongRepository implements SongCollection
{
    /** @var array<string, Song> */
    private array $store = [];

    public function save(Song $song): void
    {
        $this->store[$song->songId()->value()] = $song;
    }

    public function findById(SongId $id): ?Song
    {
        return $this->store[$id->value()] ?? null;
    }

    /** @return Song[] */
    public function findAll(): array
    {
        return array_values($this->store);
    }

    public function delete(SongId $id): void
    {
        unset($this->store[$id->value()]);
    }
}
