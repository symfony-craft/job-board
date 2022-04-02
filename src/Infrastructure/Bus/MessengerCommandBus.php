<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Infrastructure\Bus;

use Symfony\Component\Messenger\MessageBusInterface;
use SymfonyCraft\JobBoard\Application\Command\Command;
use SymfonyCraft\JobBoard\Application\Command\CommandBus;

final class MessengerCommandBus implements CommandBus
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
