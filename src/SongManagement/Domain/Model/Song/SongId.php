<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Model\Song;

use App\Shared\Domain\IdentityTrait;

/**
 * SongId Value Object.
 *
 * Pur Domain implementation with no framework dependencies.
 *
 * @author Lionel KOUAME
 */
readonly class SongId
{
    use IdentityTrait;
}
