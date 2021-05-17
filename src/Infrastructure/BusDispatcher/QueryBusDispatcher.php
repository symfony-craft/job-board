<?php

namespace App\Infrastructure\BusDispatcher;

use App\Application\Query\Query;
use App\Application\Query\QueryHandler;

class QueryBusDispatcher
{
    private $handlers;

    public function __construct(iterable $handlers)
    {
        foreach ($handlers as $handler) {
            $this->handlers[$handler->listenTo()] = $handler;
        }
    }

    public function dispatch(Query $query): array
    {
        $queryClass = get_class($query);

        /** @var QueryHandler $handler */
        $handler = $this->handlers[$queryClass];
        if($handler == null) {
            throw new \LogicException("Handler for command $queryClass not found");
        }
        return $handler->handle($query);
    }
}
