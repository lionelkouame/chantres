<?php

namespace App\SongManagement\Infrastructure\Api\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\SongManagement\Application\Category\Command\CreateCategoryCommand;
use App\SongManagement\Domain\Category\ValueObject\CategoryId;
use App\SongManagement\Infrastructure\Api\Input\CreateCategoryInput;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Uid\Uuid;

/**
 * @implements ProcessorInterface<CreateCategoryInput, void>
 */
readonly class CreateCategoryProcessor implements ProcessorInterface
{
    public function __construct(
        private MessageBusInterface $messageBus,
        private RequestStack $requestStack,
    )
    {}

    /**
     * @param CreateCategoryInput $data
     *
     * @throws ExceptionInterface
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        $categoryId = CategoryId::generate();
        $id = Uuid::fromString($categoryId->getValue());

        $this->messageBus->dispatch(
            new CreateCategoryCommand($id->toString(), $data->name)
        );

        $request = $this->requestStack->getCurrentRequest();

        $request->headers->set('X-Resource-ID',$id);
    }
}
