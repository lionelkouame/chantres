<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Exception;

use App\SongManagement\Domain\Model\Song\SongId;

/**
 * Raised when trying to add a Song whose identifier already exists in the library.
 *
 * @author Lionel KOUAME
 */
final class SongAlreadyExistsException extends \DomainException
{
    public static function withId(SongId $id): self
    {
        return new self(sprintf('A song with id "%s" already exists in the library.', $id->value()));
    }
}
