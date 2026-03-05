<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Event;

use App\Shared\Domain\DomainEventInterface;
use App\SongManagement\Domain\Model\Arrangement\ArrangementId;
use App\SongManagement\Domain\Model\Song\SongId;

/**
 * Domain Event raised when a new Arrangement is added to a Song.
 *
 * Carries the identity of the song and the arrangement so downstream
 * contexts can react without coupling to the Song aggregate directly.
 *
 * @author Lionel KOUAME
 */
readonly class ArrangementAddedToSong implements DomainEventInterface
{
    public function __construct(
        private SongId $songId,
        private ArrangementId $arrangementId,
        private \DateTimeImmutable $occurredOn = new \DateTimeImmutable(),
    ) {
    }

    public function songId(): SongId
    {
        return $this->songId;
    }

    public function arrangementId(): ArrangementId
    {
        return $this->arrangementId;
    }

    public function occurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
