<?php

namespace App\Application\Event\RoomBooked;

use App\Application\Event\Event;

class RoomBookedEvent implements Event
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
