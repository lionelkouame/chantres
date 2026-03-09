<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Port;

use App\SongManagement\Domain\Model\Song\Song;
use App\SongManagement\Domain\Model\Song\SongId;

/**
 * Driven port for Song persistence.
 *
 * Defined in the Domain layer, implemented in the Infrastructure layer.
 *
 * @author Lionel KOUAME
 */
interface SongCollection
{
    public function save(Song $song): void;

    public function findById(SongId $id): ?Song;

    /** @return Song[] */
    public function findAll(): array;

    public function delete(SongId $id): void;
}
