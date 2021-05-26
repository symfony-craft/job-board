<?php

namespace App\Application\Command\UnbookARoom;

use App\Application\Command\Command;

class UnbookARoomCommand implements Command
{
    private string $roomId;

    public function __construct(string $roomId)
    {
        $this->roomId = $roomId;
    }

    public function getRoomId(): string
    {
        return $this->roomId;
    }
}
