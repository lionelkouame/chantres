<?php

declare(strict_types=1);

namespace App\SongManagement\Infrastructure\Doctrine\Category;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DoctrineCategoryRepository::class)]
#[ORM\Table(name: 'category')]
class CategoryEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    private string  $id;

    private string $name;

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

}
