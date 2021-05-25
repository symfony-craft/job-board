<?php

namespace App\Application\Command;

interface CommandBus
{
    public function dispatch(Command $command): void;
}
