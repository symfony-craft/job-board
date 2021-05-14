<?php

namespace App\Tests\InMemory\Repository;

use App\Domain\Room;
use App\Domain\RoomRepository;

class InMemoryRoomRepository implements RoomRepository
{
    public array $roomCollection;

    public function add(Room $room): void
    {
        $this->roomCollection[] = $room;
    }
}
