<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Model\Song;

use App\SongManagement\Domain\Model\Contributor\ContributorIdCollection;

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
        private Title $title,
        private ContributorIdCollection $contributors,
    ) {
    }

    public static function create(SongId $id, Title $title, ContributorIdCollection $contributors): self
    {
        if ($contributors->isEmpty()) {
            throw new \InvalidArgumentException('A song must have at least one contributor.');
        }

        return new self($id, $title, $contributors);
    }

    public function songId(): SongId
    {
        return $this->songId;
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function contributors(): ContributorIdCollection
    {
        return $this->contributors;
    }
}
