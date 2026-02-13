<?php

declare(strict_types=1);

namespace App\SongManagement\Category\Infrastructure\Api\Input;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\SongManagement\Category\Infrastructure\Api\Processor\CreateCategoryProcessor;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: 'SongManagement',
    operations: [
        new Post(
            uriTemplate: 'categories',
            status: Response::HTTP_CREATED,
            output: false,
            processor: CreateCategoryProcessor::class
        ),
    ],
    routePrefix: 'song/'
)]
final class CreateCategoryInput
{
    #[Assert\NotBlank]
    public string $name;
}
