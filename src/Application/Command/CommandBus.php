<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Application\Command;

interface CommandBus
{
    public function dispatch(Command $command): void;
}
