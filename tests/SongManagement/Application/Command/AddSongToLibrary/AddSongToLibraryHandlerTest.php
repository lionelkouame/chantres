<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Application\Command\AddSongToLibrary;

use App\Shared\Domain\DomainEventInterface;
use App\Shared\Domain\Port\DomainEventBusInterface;
use App\SongManagement\Application\Command\AddSongToLibrary\AddSongToLibraryCommand;
use App\SongManagement\Application\Command\AddSongToLibrary\AddSongToLibraryHandler;
use App\SongManagement\Domain\Event\SongAddedToLibrary;
use App\SongManagement\Domain\Exception\SongAlreadyExistsException;
use App\SongManagement\Domain\Model\Contributor\ContributorId;
use App\SongManagement\Domain\Model\Song\Song;
use App\SongManagement\Domain\Model\Song\SongId;
use App\SongManagement\Domain\Model\Song\Title;
use App\SongManagement\Domain\Port\SongRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class AddSongToLibraryHandlerTest extends TestCase
{
    private const string SONG_UUID     = '550e8400-e29b-41d4-a716-446655440000';
    private const string COMPOSER_UUID = '6ba7b810-9dad-11d1-80b4-00c04fd430c8';
    private const string LYRICIST_UUID = '6ba7b810-9dad-11d1-80b4-00c04fd430c9';

    private SongRepositoryInterface&MockObject $repository;
    private DomainEventBusInterface&MockObject $eventBus;
    private AddSongToLibraryHandler $handler;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(SongRepositoryInterface::class);
        $this->eventBus   = $this->createMock(DomainEventBusInterface::class);
        $this->handler    = new AddSongToLibraryHandler($this->repository, $this->eventBus);
    }

    private function validCommand(): AddSongToLibraryCommand
    {
        return new AddSongToLibraryCommand(
            songId:     self::SONG_UUID,
            title:      'Amazing Grace',
            composerId: self::COMPOSER_UUID,
            lyricistId: self::LYRICIST_UUID,
        );
    }

    public function testPersistsTheSong(): void
    {
        $this->repository->method('findById')->willReturn(null);

        $this->repository
            ->expects(self::once())
            ->method('save')
            ->with(self::callback(fn (Song $song): bool => self::SONG_UUID === $song->songId()->value()
                && 'Amazing Grace' === $song->title()->value()
                && self::COMPOSER_UUID === $song->composerId()->value()
                && self::LYRICIST_UUID === $song->lyricistId()->value()
            ));

        ($this->handler)($this->validCommand());
    }

    public function testDispatchesSongAddedToLibraryEvent(): void
    {
        $this->repository->method('findById')->willReturn(null);
        $this->repository->method('save');

        $this->eventBus
            ->expects(self::once())
            ->method('dispatch')
            ->with(self::callback(fn (DomainEventInterface $event): bool => $event instanceof SongAddedToLibrary
                && self::SONG_UUID === $event->songId()->value()
                && 2 === $event->contributorIdList()->count()
            ));

        ($this->handler)($this->validCommand());
    }

    public function testThrowsWhenSongAlreadyExists(): void
    {
        $existingSong = Song::create(
            SongId::fromString(self::SONG_UUID),
            new Title('Already there'),
            ContributorId::fromString(self::COMPOSER_UUID),
            ContributorId::fromString(self::LYRICIST_UUID),
        );
        $this->repository->method('findById')->willReturn($existingSong);

        $this->repository->expects(self::never())->method('save');
        $this->eventBus->expects(self::never())->method('dispatch');

        $this->expectException(SongAlreadyExistsException::class);

        ($this->handler)($this->validCommand());
    }

    public function testThrowsOnInvalidSongId(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        ($this->handler)(new AddSongToLibraryCommand(
            songId:     'not-a-uuid',
            title:      'Amazing Grace',
            composerId: self::COMPOSER_UUID,
            lyricistId: self::LYRICIST_UUID,
        ));
    }

    public function testThrowsOnEmptyTitle(): void
    {
        $this->repository->method('findById')->willReturn(null);

        $this->expectException(\InvalidArgumentException::class);

        ($this->handler)(new AddSongToLibraryCommand(
            songId:     self::SONG_UUID,
            title:      '',
            composerId: self::COMPOSER_UUID,
            lyricistId: self::LYRICIST_UUID,
        ));
    }
}
