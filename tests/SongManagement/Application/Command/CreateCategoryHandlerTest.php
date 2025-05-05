<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Application\Command;

use App\SongManagement\Application\Category\Command\CreateCategoryCommand;
use App\SongManagement\Application\Category\Command\CreateCategoryHandler;
use App\SongManagement\Category\Domain\Category;
use App\SongManagement\Category\Domain\Repository\CategoryRepository;
use PHPUnit\Framework\TestCase;

class CreateCategoryHandlerTest extends TestCase
{
    public function testItCreatesCategoryAndSavesIt(): void
    {
        $repository = $this->createMock(CategoryRepository::class);

        $repository->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(Category::class));

        $handler = new CreateCategoryHandler($repository);

        $command = new CreateCategoryCommand(
            name: 'Gospel',
            id: '550e8400-e29b-41d4-a716-446655440000'
        );

        $handler($command);
    }
}
