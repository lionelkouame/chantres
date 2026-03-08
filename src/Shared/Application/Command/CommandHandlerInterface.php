<?php

declare(strict_types=1);

namespace App\Shared\Application\Command;

/**
 * Marker interface for all Command Handlers.
 *
 * Each handler is responsible for exactly one Command type.
 * The concrete __invoke() signature is typed to the specific Command,
 * allowing full type-safety in handlers while remaining wire-compatible
 * with message bus autoconfiguration (e.g. Symfony Messenger).
 *
 * @author Lionel KOUAME
 */
interface CommandHandlerInterface
{
}
