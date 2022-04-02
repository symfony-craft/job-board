<?php

namespace SymfonyCraft\JobBoard\Application\Command;

interface CommandBus
{
    public function dispatch(Command $command): void;
}
