<?php

declare(strict_types=1);

namespace App\Shared\Domain\User\Profile;

use App\Shared\Domain\IdentityTrait;

/**
 * LegalPersonId Value Object.
 *
 * Pure Domain implementation with no framework dependencies.
 *
 * @author Lionel KOUAME
 */
readonly class LegalPersonId
{
    use IdentityTrait;
}
