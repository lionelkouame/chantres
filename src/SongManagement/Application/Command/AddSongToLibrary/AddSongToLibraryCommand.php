<?php

declare(strict_types=1);

namespace App\SongManagement\Application\Command\AddSongToLibrary;

use App\Shared\Application\Command\CommandInterface;

/**
 * Command for adding a new Song to the library.
 *
 * Carries only primitives so that the Application layer boundary
 * stays decoupled from the Domain's value objects.
 * The handler is responsible for constructing domain objects from these values.
 *
 * @author Lionel KOUAME
 */
final readonly class AddSongToLibraryCommand implements CommandInterface
{
    public function __construct(
        public string $songId,
        public string $title,
        public string $composerId,
        public string $lyricistId,
    ) {
    }
}
