<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Model\Contributor;

use App\Shared\Domain\FullName;

/**
 * Aggregate Root representing a Contributor within the catalog.
 *
 * This class is the core of the "SongManagement" domain. It ensures the
 * business rules without any dependency on external frameworks.
 *
 * @author Lionel KOUAME
 */
readonly class Contributor
{
    private function __construct(
        private ContributorId $contributorId,
        private FullName $fullName,
    ) {
    }

    public function contributorId(): ContributorId
    {
        return $this->contributorId;
    }

    public function fullName(): FullName
    {
        return $this->fullName;
    }
}
