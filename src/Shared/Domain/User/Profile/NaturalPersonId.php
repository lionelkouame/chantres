<?php

declare(strict_types=1);

namespace App\Shared\Domain\User\Profile;

use App\Shared\Domain\IdentityTrait;

/**
 * NaturalPersonId Value Object.
 *
 * Pure Domain implementation with no framework dependencies.
 *
 * @author Lionel KOUAME
 */
readonly class NaturalPersonId
{
    use IdentityTrait;
}
