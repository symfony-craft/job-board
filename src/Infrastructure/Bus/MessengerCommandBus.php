<?php

namespace SymfonyCraft\JobBoard\Infrastructure\Bus;

use SymfonyCraft\JobBoard\Application\Command\Command;
use SymfonyCraft\JobBoard\Application\Command\CommandBus;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerCommandBus implements CommandBus
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function dispatch(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
