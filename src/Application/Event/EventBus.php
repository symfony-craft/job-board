<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Application\Event;

interface EventBus
{
    public function dispatch(Event $event): void;
}
