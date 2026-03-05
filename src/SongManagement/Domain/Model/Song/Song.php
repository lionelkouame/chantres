<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Model\Song;

use App\Shared\Domain\DomainEventInterface;
use App\SongManagement\Domain\Event\SongAddedToLibrary;
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
class Song
{
    /** @var DomainEventInterface[] */
    private array $domainEvents = [];

    private function __construct(
        private readonly SongId $songId,
    ) {
    }

    /**
     * Factory method: creates a Song and records a SongAddedToLibrary event.
     */
    public static function add(SongId $id, ContributorIdCollection $contributorIds): self
    {
        $song = new self($id);
        $song->record(new SongAddedToLibrary($id, $contributorIds));

        return $song;
    }

    public function songId(): SongId
    {
        return $this->songId;
    }

    /**
     * Returns and clears all recorded domain events.
     *
     * @return DomainEventInterface[]
     */
    public function releaseEvents(): array
    {
        $events = $this->domainEvents;
        $this->domainEvents = [];

        return $events;
    }

    private function record(DomainEventInterface $event): void
    {
        $this->domainEvents[] = $event;
    }
}
