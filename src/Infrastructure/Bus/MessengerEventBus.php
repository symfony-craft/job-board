<?php

namespace App\Infrastructure\Bus;

use App\Application\Event\Event;
use App\Application\Event\EventBus;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerEventBus implements EventBus
{
    private MessageBusInterface $eventBus;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function dispatch(Event $event): void
    {
        $this->eventBus->dispatch($event);
    }
}
