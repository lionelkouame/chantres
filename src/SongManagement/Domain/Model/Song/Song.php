<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Model\Song;

use App\SongManagement\Domain\Model\Arrangement\ArrangementCollection;
use App\SongManagement\Domain\Model\Contributor\ContributorId;

/**
 * Aggregate Root representing a Song within the catalog.
 *
 * This class is the core of the "SongManagement" domain. It ensures the
 * integrity of song data (title, composer, lyricist, arrangements) and
 * encapsulates business rules without any dependency on external frameworks.
 *
 * @author Lionel KOUAME
 */
readonly class Song
{
    private function __construct(
        private SongId $songId,
        private Title $title,
        private ContributorId $composerId,
        private ContributorId $lyricistId,
        private ArrangementCollection $arrangements,
    ) {
    }

    public static function create(
        SongId $id,
        Title $title,
        ContributorId $composerId,
        ContributorId $lyricistId,
        ArrangementCollection $arrangements,
    ): self {
        return new self($id, $title, $composerId, $lyricistId, $arrangements);
    }

    public function songId(): SongId
    {
        return $this->songId;
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function composerId(): ContributorId
    {
        return $this->composerId;
    }

    public function lyricistId(): ContributorId
    {
        return $this->lyricistId;
    }

    public function arrangements(): ArrangementCollection
    {
        return $this->arrangements;
    }
}
