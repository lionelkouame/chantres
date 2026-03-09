<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Model\Arrangement;

/**
 * Represents a musical arrangement of a Song.
 *
 * @author Lionel KOUAME
 */
final readonly class Arrangement
{
    public function __construct(
        private ArrangementId $arrangementId,
    ) {
    }

    public function arrangementId(): ArrangementId
    {
        return $this->arrangementId;
    }
}
