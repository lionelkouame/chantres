<?php

declare(strict_types=1);

namespace App\SongManagement\Infrastructure\Doctrine\Category;

use App\Shared\Infrastructure\Doctrine\Embeddable\CreatedAtEmbeddable;
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

    public function __construct(string $id, string $name, CreatedAtEmbeddable $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->createdAt = $createdAt;
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
}
