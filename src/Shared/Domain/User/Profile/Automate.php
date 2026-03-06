<?php

declare(strict_types=1);

namespace App\Shared\Domain\User\Profile;

use App\Shared\Domain\Name;

/**
 * Profile for an Automate (bot, system integration, automated service).
 *
 * @author Lionel KOUAME
 */
readonly class Automate implements UserProfileInterface
{
    public function __construct(
        private Name $serviceName,
    ) {
    }

    public static function create(Name $serviceName): self
    {
        return new self($serviceName);
    }

    public function serviceName(): Name
    {
        return $this->serviceName;
    }

    public function displayName(): string
    {
        return $this->serviceName->value();
    }
}
