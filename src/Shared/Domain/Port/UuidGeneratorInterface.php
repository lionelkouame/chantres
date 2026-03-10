<?php

declare(strict_types=1);

namespace App\Shared\Domain\Port;

/**
 * Driven port for generating UUID identifiers.
 *
 * Defined in the Domain layer, implemented in the Infrastructure layer
 * (e.g. Symfony UID, Ramsey UUID).
 *
 * @author Lionel KOUAME
 */
interface UuidGeneratorInterface
{
    public function generate(): string;
}
