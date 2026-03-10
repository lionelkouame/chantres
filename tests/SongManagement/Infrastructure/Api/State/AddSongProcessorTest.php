<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Infrastructure\Api\State;

use ApiPlatform\Metadata\Post;
use App\Shared\Domain\Port\UuidGeneratorInterface;
use App\SongManagement\Application\Command\AddSongToLibrary\AddSongToLibraryHandlerInterface;
use App\SongManagement\Domain\Exception\SongAlreadyExistsException;
use App\SongManagement\Domain\Model\Song\SongId;
use App\SongManagement\Infrastructure\Api\Resource\SongResource;
use App\SongManagement\Infrastructure\Api\State\AddSongProcessor;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class AddSongProcessorTest extends TestCase
{
    private const string SONG_UUID = '550e8400-e29b-41d4-a716-446655440000';
    private const string COMPOSER_UUID = '6ba7b810-9dad-11d1-80b4-00c04fd430c8';
    private const string LYRICIST_UUID = '6ba7b810-9dad-11d1-80b4-00c04fd430c9';

    private AddSongToLibraryHandlerInterface&MockObject $handler;
    private UuidGeneratorInterface&MockObject $uuidGenerator;
    private AddSongProcessor $processor;

    protected function setUp(): void
    {
        $this->handler = $this->createMock(AddSongToLibraryHandlerInterface::class);
        $this->uuidGenerator = $this->createMock(UuidGeneratorInterface::class);
        $this->uuidGenerator->method('generate')->willReturn(self::SONG_UUID);
        $this->processor = new AddSongProcessor($this->handler, $this->uuidGenerator);
    }

    private function resource(): SongResource
    {
        $resource = new SongResource();
        $resource->title = 'Amazing Grace';
        $resource->composerId = self::COMPOSER_UUID;
        $resource->lyricistId = self::LYRICIST_UUID;

        return $resource;
    }

    public function testItGeneratesSongIdAndInvokesHandler(): void
    {
        $this->handler->expects(self::once())->method('__invoke');

        $resource = $this->resource();
        self::assertSame('', $resource->songId);

        $result = $this->processor->process($resource, new Post());

        self::assertSame(self::SONG_UUID, $result->songId);
    }

    public function testItInvokesHandlerAndReturnsResource(): void
    {
        $this->handler->expects(self::once())->method('__invoke');

        $resource = $this->resource();
        $result = $this->processor->process($resource, new Post());

        self::assertSame($resource, $result);
    }

    public function testItPropagatesSongAlreadyExistsException(): void
    {
        $this->handler->method('__invoke')
            ->willThrowException(SongAlreadyExistsException::withId(SongId::fromString(self::SONG_UUID)));

        $this->expectException(SongAlreadyExistsException::class);

        $this->processor->process($this->resource(), new Post());
    }
}
