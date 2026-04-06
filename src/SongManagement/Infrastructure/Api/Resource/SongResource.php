<?php

declare(strict_types=1);

namespace App\SongManagement\Infrastructure\Api\Resource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\SongManagement\Domain\Exception\ContributorNotFoundException;
use App\SongManagement\Domain\Exception\SongAlreadyExistsException;
use App\SongManagement\Infrastructure\Api\State\AddSongProcessor;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * API resource for adding a Song to the library.
 *
 * @author Lionel KOUAME
 */
#[ApiResource(
    shortName: 'Song',
    operations: [
        new Post(
            uriTemplate: '/songs',
            status: Response::HTTP_CREATED,
            exceptionToStatus: [
                SongAlreadyExistsException::class => Response::HTTP_CONFLICT,
                ContributorNotFoundException::class => Response::HTTP_UNPROCESSABLE_ENTITY,
                \InvalidArgumentException::class => Response::HTTP_UNPROCESSABLE_ENTITY,
            ],
            processor: AddSongProcessor::class,
        ),
    ],
)]
final class SongResource
{
    public function __construct(
        #[ApiProperty(writable: false)]
        public string $songId = '',

        #[Assert\NotBlank]
        public string $title = '',

        #[Assert\NotBlank]
        #[Assert\Uuid]
        public string $composerId = '',

        #[Assert\NotBlank]
        #[Assert\Uuid]
        public string $lyricistId = '',
    ) {
    }
}
