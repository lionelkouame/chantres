<?php

declare(strict_types=1);

namespace App\SongManagement\Application\Command\AddSongToLibrary;

interface AddSongToLibraryHandlerInterface
{
    public function __invoke(AddSongToLibraryCommand $command): void;
}
