<?php

declare(strict_types=1);

namespace App\SongManagement\Domain\Model\Arrangement;

/**
 * Typed collection of Arrangement value objects.
 *
 * @author Lionel KOUAME
 */
final class ArrangementCollection
{
    /** @var Arrangement[] */
    private readonly array $arrangements;

    public function __construct(Arrangement ...$arrangements)
    {
        $this->arrangements = $arrangements;
    }

    /** @return Arrangement[] */
    public function all(): array
    {
        return $this->arrangements;
    }

    public function isEmpty(): bool
    {
        return [] === $this->arrangements;
    }

    public function count(): int
    {
        return count($this->arrangements);
    }
}
