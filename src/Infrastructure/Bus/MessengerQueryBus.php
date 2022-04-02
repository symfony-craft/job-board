<?php

namespace App\Infrastructure\Bus;

use SymfonyCraft\JobBoard\Application\Query\Query;
use SymfonyCraft\JobBoard\Application\Query\QueryBus;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerQueryBus implements QueryBus
{
    use HandleTrait {
        handle as handleQuery;
    }

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    public function handle(Query $query)
    {
        return $this->handleQuery($query);
    }
}
