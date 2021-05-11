<?php

namespace App\Infrastructure\CommandBus;

use App\Application\Command\Command;
use App\Application\Command\CommandHandler;

class CommandBusDispatcher
{
    private $handlers;

    public function __construct(iterable $handlers)
    {
        foreach ($handlers as $handler) {
            $this->handlers[$handler->listenTo()] = $handler;
        }
    }

    public function dispatch(Command $command): string
    {
        $commandClass = get_class($command);

        /** @var CommandHandler $handler */
        $handler = $this->handlers[$commandClass];
        if($handler == null) {
            throw new \LogicException("Handler for command $commandClass not found");
        }
        return $handler->handle($command);
    }

}
