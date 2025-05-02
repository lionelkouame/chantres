<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Doctrine\Embeddable;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class CreatedAtEmbeddable
{
    #[ORM\Column(name: 'created_at', type: 'datetime_immutable')]
    private \DateTimeImmutable $value;

    public function __construct(?\DateTimeImmutable $value = null)
    {
        $this->value = $value ?? new \DateTimeImmutable();
    }

    public function getValue(): \DateTimeImmutable
    {
        return $this->value;
    }
}
