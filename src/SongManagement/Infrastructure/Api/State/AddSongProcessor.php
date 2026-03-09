<?php

declare(strict_types=1);

namespace App\SongManagement\Infrastructure\Api\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\SongManagement\Application\Command\AddSongToLibrary\AddSongToLibraryCommand;
use App\SongManagement\Application\Command\AddSongToLibrary\AddSongToLibraryHandlerInterface;
use App\SongManagement\Infrastructure\Api\Resource\SongResource;

/**
 * Bridges API Platform POST /api/songs → AddSongToLibraryCommand.
 *
 * @implements ProcessorInterface<SongResource, SongResource>
 *
 * @author Lionel KOUAME
 */
final readonly class AddSongProcessor implements ProcessorInterface
{
    public function __construct(
        private AddSongToLibraryHandlerInterface $handler,
    ) {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): SongResource
    {
        ($this->handler)(new AddSongToLibraryCommand(
            songId: $data->songId,
            title: $data->title,
            composerId: $data->composerId,
            lyricistId: $data->lyricistId,
        ));

        return $data;
    }
}
