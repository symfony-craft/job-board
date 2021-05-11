<?php

namespace App\Application\Command\TestCommand;

use App\Application\Command\Command;
use App\Application\Command\CommandHandler;

class TestCommandHandler implements CommandHandler
{
    public function handle(Command $command): string
    {
        return $command->message;
    }

    public function listenTo(): string
    {
        return TestCommand::class;
    }

}
