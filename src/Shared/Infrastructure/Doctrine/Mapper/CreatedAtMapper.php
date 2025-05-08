<?php

namespace App\Shared\Infrastructure\Doctrine\Mapper;

use App\Shared\Domain\ValueObject\CreatedAt;
use App\Shared\Infrastructure\Doctrine\Embeddable\CreatedAtEmbeddable;

final class CreatedAtMapper
{
    public static function toValueObject(CreatedAtEmbeddable $embeddable): CreatedAt
    {
        return new CreatedAt($embeddable->getValue());
    }

    public static function toEmbeddable(CreatedAt $vo): CreatedAtEmbeddable
    {
        return new CreatedAtEmbeddable($vo->getValue());
    }
}
