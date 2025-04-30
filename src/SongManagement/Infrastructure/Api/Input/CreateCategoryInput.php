<?php

declare(strict_types=1);

namespace App\SongManagement\Infrastructure\Api\Input;

use App\SongManagement\Infrastructure\Api\Processor\CreateCategoryProcessor;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;

#[ApiResource(
    shortName: 'SongManagement',
    operations: [
        new Post(
            uriTemplate: 'categories',
            processor: CreateCategoryProcessor::class,
        ),
    ],
    routePrefix: 'song/'
)]
final class CreateCategoryInput
{

    #[Assert\NotBlank]
    public string $name;
}
