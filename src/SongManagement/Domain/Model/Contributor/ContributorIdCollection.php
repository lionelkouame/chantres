<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Model\Contributor;

/**
 * Typed collection of ContributorId value objects.
 *
 * @author Lionel KOUAME
 */
final class ContributorIdCollection
{
    /** @var ContributorId[] */
    private readonly array $ids;

    public function __construct(ContributorId ...$ids)
    {
        $this->ids = $ids;
    }

    /** @return ContributorId[] */
    public function all(): array
    {
        return $this->ids;
    }

    public function isEmpty(): bool
    {
        return [] === $this->ids;
    }

    public function count(): int
    {
        return count($this->ids);
    }
}
