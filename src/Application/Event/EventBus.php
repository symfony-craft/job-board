<?php

namespace App\Application\Event;

interface EventBus
{
    public function dispatch(Event $event);
}
