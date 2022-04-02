<?php

namespace SymfonyCraft\JobBoard\Application\Event;

interface EventBus
{
    public function dispatch(Event $event);
}
