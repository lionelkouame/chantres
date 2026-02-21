<?php

namespace App\SongManagement\Category\Infrastructure\Api\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\SongManagement\Category\Application\Command\CreateCategoryCommand;
use App\SongManagement\Category\Domain\ValueObject\CategoryId;
use App\SongManagement\Category\Domain\ValueObject\CategoryName;
use App\SongManagement\Category\Infrastructure\Api\Input\CreateCategoryInput;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Webmozart\Assert\Assert;

/**
 * @implements ProcessorInterface<CreateCategoryInput, void>
 */
readonly class CreateCategoryProcessor implements ProcessorInterface
{
    public function __construct(
        private MessageBusInterface $messageBus,
        private RequestStack $requestStack,
        private LoggerInterface $logger
    ) {
    }

    /**
     * @param CreateCategoryInput $data
     *
     * @throws ExceptionInterface
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        $this->logger->info("#process-post: begin Add new Category");

        $categoryId = CategoryId::generate();

        Assert::notEmpty($data, 'Data cannot be empty');
        $categoryName = new CategoryName($data->name);

        $this->messageBus->dispatch(
            new CreateCategoryCommand($categoryId,$categoryName)
        );

        $request = $this->requestStack->getCurrentRequest();

        $request->headers->set('X-Resource-ID', $categoryId->getValue());

        $this->logger->info("#process-post: end Add new Category");
    }
}
