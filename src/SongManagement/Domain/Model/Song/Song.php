<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Model\Song;

/**
 * Aggregate Root representing a Song within the catalog.
 *
 * This class is the core of the "SongManagement" domain. It ensures the
 * integrity of song data (title, composer, etc.) and encapsulates
 * business rules without any dependency on external frameworks.
 *
 * @author Lionel KOUAME
 */
readonly class Song
{
    private function __construct(
        private SongId $songId,
    ) {
    }

    public function songId(): SongId
    {
        return $this->songId;
    }
}
