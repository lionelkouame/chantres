<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Port;

use App\SongManagement\Domain\Model\Contributor\Contributor;
use App\SongManagement\Domain\Model\Contributor\ContributorId;

/**
 * Driven port for Contributor persistence.
 *
 * Defined in the Domain layer, implemented in the Infrastructure layer.
 *
 * @author Lionel KOUAME
 */
interface ContributorCollection
{
    public function save(Contributor $contributor): void;

    public function findById(ContributorId $id): ?Contributor;

    /** @return Contributor[] */
    public function findAll(): array;

    public function delete(ContributorId $id): void;
}
