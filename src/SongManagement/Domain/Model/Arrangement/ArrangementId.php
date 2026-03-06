<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Model\Arrangement;

use App\Shared\Domain\IdentityTrait;

/**
 * ArrangementId Value Object.
 *
 * Pure Domain implementation with no framework dependencies.
 *
 * @author Lionel KOUAME
 */
readonly class ArrangementId
{
    use IdentityTrait;
}
