<?php

declare(strict_types=1);

namespace App\SongManagement\Application\UseCase\AddSongToLibrary;

/**
 * Command for adding a new Song to the library.
 *
 * Carries only primitives so that the Application layer boundary
 * stays decoupled from the Domain's value objects.
 * The handler is responsible for constructing domain objects from these values.
 *
 * @author Lionel KOUAME
 */
final readonly class AddSongToLibraryCommand
{
    public function __construct(
        public string $songId,
        public string $title,
        public string $composerId,
        public string $lyricistId,
    ) {
    }
}
