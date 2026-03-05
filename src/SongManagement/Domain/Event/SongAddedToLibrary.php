<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Event;

use App\Shared\Domain\DomainEventInterface;
use App\SongManagement\Domain\Model\Contributor\ContributorIdCollection;
use App\SongManagement\Domain\Model\Song\SongId;

/**
 * Domain Event raised when a Song is added to the library.
 *
 * Carries the identity of the song and all ContributorIds associated with it
 * (composer, arranger, lyricist, etc.) so downstream contexts can react
 * without coupling to the Song aggregate directly.
 *
 * @author Lionel KOUAME
 */
readonly class SongAddedToLibrary implements DomainEventInterface
{
    public function __construct(
        private SongId $songId,
        private ContributorIdCollection $contributorIdList,
        private \DateTimeImmutable $occurredOn = new \DateTimeImmutable(),
    ) {
    }

    public function songId(): SongId
    {
        return $this->songId;
    }

    public function contributorIdList(): ContributorIdCollection
    {
        return $this->contributorIdList;
    }

    public function occurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
