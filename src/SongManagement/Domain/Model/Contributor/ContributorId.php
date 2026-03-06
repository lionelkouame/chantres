<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Model\Contributor;

use App\Shared\Domain\IdentityTrait;

/**
 * ContributorId Value Object.
 *
 * Pur Domain implementation with no framework dependencies.
 *
 * @author Lionel KOUAME
 */
readonly class ContributorId
{
    use IdentityTrait;
}
