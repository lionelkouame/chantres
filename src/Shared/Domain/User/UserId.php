<?php

declare(strict_types=1);

namespace App\Shared\Domain\User;

use App\Shared\Domain\IdentityTrait;

/**
 * SongId Value Object.
 *
 * Pur Domain implementation with no framework dependencies.
 *
 * @author Lionel KOUAME
 */
readonly class UserId
{
    use IdentityTrait;
}
