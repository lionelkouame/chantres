<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Model\Song;

use App\Shared\Domain\StringValueObjectInterface;

/**
 * Title Value Object.
 *
 * Business rule: a title must be a non-empty string.
 *
 * @author Lionel KOUAME
 */
readonly class Title
{
    use StringValueObjectInterface;

    public function __construct(string $value)
    {
        if ('' === trim($value)) {
            throw new \InvalidArgumentException('Song title cannot be empty.');
        }

        $this->value = $value;
    }
}
