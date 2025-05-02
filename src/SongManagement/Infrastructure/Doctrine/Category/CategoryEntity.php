<?php

declare(strict_types=1);

namespace App\SongManagement\Infrastructure\Doctrine\Category;

use App\Shared\Infrastructure\Doctrine\Embeddable\CreatedAtEmbeddable;
use App\Shared\Infrastructure\Doctrine\Embeddable\UpdatedAtEmbeddable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'category')]
class CategoryEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    private string $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Embedded(class: CreatedAtEmbeddable::class, columnPrefix: false)]
    private CreatedAtEmbeddable $createdAt;

    #[ORM\Embedded(class: UpdatedAtEmbeddable::class, columnPrefix: false)]
    private UpdatedAtEmbeddable $updatedAt;

    public function __construct(string $id, string $name, CreatedAtEmbeddable $createdAt, UpdatedAtEmbeddable $updatedAt )
    {
        $this->id = $id;
        $this->name = $name;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): CreatedAtEmbeddable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): UpdatedAtEmbeddable
    {
        return $this->updatedAt;
    }
}
