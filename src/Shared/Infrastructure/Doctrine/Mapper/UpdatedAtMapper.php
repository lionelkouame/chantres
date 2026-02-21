<?php

namespace App\Shared\Infrastructure\Doctrine\Mapper;

use App\Shared\Domain\ValueObject\UpdatedAt;
use App\Shared\Infrastructure\Doctrine\Embeddable\UpdatedAtEmbeddable;

class UpdatedAtMapper
{
    public static function toValueObject(UpdatedAtEmbeddable $embeddable): UpdatedAt
    {
        return new UpdatedAt($embeddable->getValue());
    }

    public static function toEmbeddable(UpdatedAt $vo): UpdatedAtEmbeddable
    {
        return new UpdatedAtEmbeddable($vo->getValue());
    }
}
