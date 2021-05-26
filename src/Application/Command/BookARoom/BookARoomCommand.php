<?php

namespace App\Application\Command\BookARoom;

use App\Application\Command\Command;

class BookARoomCommand implements Command
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
