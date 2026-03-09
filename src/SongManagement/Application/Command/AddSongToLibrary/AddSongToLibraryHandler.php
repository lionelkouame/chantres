<?php

declare(strict_types=1);

namespace App\SongManagement\Application\Command\AddSongToLibrary;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Port\DomainEventBusInterface;
use App\SongManagement\Domain\Event\SongAddedToLibrary;
use App\SongManagement\Domain\Exception\SongAlreadyExistsException;
use App\SongManagement\Domain\Model\Contributor\ContributorId;
use App\SongManagement\Domain\Model\Contributor\ContributorIdCollection;
use App\SongManagement\Domain\Model\Song\Song;
use App\SongManagement\Domain\Model\Song\SongId;
use App\SongManagement\Domain\Model\Song\Title;
use App\SongManagement\Domain\Port\SongRepositoryInterface;

/**
 * Handles the AddSongToLibraryCommand use case.
 *
 * Responsibilities:
 *  1. Guard against duplicate song identifiers.
 *  2. Reconstruct domain value objects from primitive command data.
 *  3. Create and persist the Song aggregate.
 *  4. Dispatch the SongAddedToLibrary domain event.
 *
 * @author Lionel KOUAME
 */
readonly class AddSongToLibraryHandler implements CommandHandlerInterface, AddSongToLibraryHandlerInterface
{
    public function __construct(
        private SongRepositoryInterface $songRepository,
        private DomainEventBusInterface $eventBus,
    ) {
    }

    public function __invoke(AddSongToLibraryCommand $command): void
    {
        $songId = SongId::fromString($command->songId);

        if ($this->songRepository->findById($songId) instanceof Song) {
            throw SongAlreadyExistsException::withId($songId);
        }

        $composerId = ContributorId::fromString($command->composerId);
        $lyricistId = ContributorId::fromString($command->lyricistId);

        $song = Song::create(
            $songId,
            new Title($command->title),
            $composerId,
            $lyricistId,
        );

        $this->songRepository->save($song);

        $this->eventBus->dispatch(
            new SongAddedToLibrary(
                $songId,
                new ContributorIdCollection($composerId, $lyricistId),
            )
        );
    }
}
