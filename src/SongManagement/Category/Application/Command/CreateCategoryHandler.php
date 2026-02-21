<?php

declare(strict_types=1);

namespace App\SongManagement\Category\Application\Command;

use App\SongManagement\Category\Domain\Category;
use App\SongManagement\Category\Domain\Repository\CategoryRepository;
use App\SongManagement\Category\Domain\ValueObject\CategoryId;
use App\SongManagement\Category\Domain\ValueObject\CategoryName;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'command.bus')]
class CreateCategoryHandler
{
    public function __construct(
        private readonly CategoryRepository $repository,
    ) {
    }

    public function __invoke(CreateCategoryCommand $command): void
    {
        $id = new CategoryId($command->id->getValue());
        $name = new CategoryName($command->name->value());

        $category = Category::create($id, $name);

        $this->repository->save($category);
    }
}
