<?php

namespace App\Shared\Infrastructure\Doctrine\Embeddable;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

#[ORM\Embeddable]
class UpdatedAtEmbeddable
{
    #[ORM\Column(name: 'updated_at', type: 'datetime_immutable')]
    private DateTimeImmutable $value;

    public function __construct(
        ?DateTimeImmutable $value = null,
    ) {
        $this->value = $value ?? new DateTimeImmutable();
    }

    public function getValue(): DateTimeImmutable
    {
        return $this->value;
    }

}
