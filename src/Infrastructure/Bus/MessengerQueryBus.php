<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Infrastructure\Bus;

use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use SymfonyCraft\JobBoard\Application\Query\Query;
use SymfonyCraft\JobBoard\Application\Query\QueryBus;
use SymfonyCraft\JobBoard\Application\Query\ViewModel;

final class MessengerQueryBus implements QueryBus
{
    use HandleTrait {
        handle as handleQuery;
    }

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    public function handle(Query $query): ViewModel
    {
        return $this->handleQuery($query);
    }
}
