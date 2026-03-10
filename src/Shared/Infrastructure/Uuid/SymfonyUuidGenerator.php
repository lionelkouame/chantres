<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Uuid;

use App\Shared\Domain\Port\UuidGeneratorInterface;
use Symfony\Component\Uid\Uuid;

/**
 * Infrastructure adapter for UUID generation using symfony/uid.
 *
 * @author Lionel KOUAME
 */
final class SymfonyUuidGenerator implements UuidGeneratorInterface
{
    public function generate(): string
    {
        return Uuid::v4()->toRfc4122();
    }
}
