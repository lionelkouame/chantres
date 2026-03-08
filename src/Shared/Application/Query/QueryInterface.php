<?php

declare(strict_types=1);

namespace App\Shared\Application\Query;

/**
 * Marker interface for all Queries.
 *
 * A Query expresses an intent to read state without side effects.
 * It is handled by exactly one QueryHandler and returns a result.
 *
 * @author Lionel KOUAME
 */
interface QueryInterface
{
}
