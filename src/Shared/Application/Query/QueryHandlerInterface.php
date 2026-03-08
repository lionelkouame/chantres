<?php

declare(strict_types=1);

namespace App\Shared\Application\Query;

/**
 * Marker interface for all Query Handlers.
 *
 * Each handler is responsible for exactly one Query type and returns a result.
 * The concrete __invoke() signature is typed to the specific Query,
 * allowing full type-safety while remaining wire-compatible with
 * message bus autoconfiguration (e.g. Symfony Messenger).
 *
 * @author Lionel KOUAME
 */
interface QueryHandlerInterface
{
}
