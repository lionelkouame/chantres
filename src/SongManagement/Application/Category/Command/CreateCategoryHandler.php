<?php

declare(strict_types=1);

namespace App\SongManagement\Application\Category\Command;

use App\SongManagement\Domain\Category\Category;
use App\SongManagement\Domain\Category\Repository\CategoryRepository;
use App\SongManagement\Domain\Category\ValueObject\CategoryId;
use App\SongManagement\Domain\Category\ValueObject\CategoryName;
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
        $id = new CategoryId($command->id);
        $name = new CategoryName($command->name);

        $category = Category::create($id, $name);

        $this->repository->save($category);
    }
}
