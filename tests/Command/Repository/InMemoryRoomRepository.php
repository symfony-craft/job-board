<?php

namespace App\Tests\Command\Repository;

use App\Domain\Room;
use App\Domain\RoomRepository;

class InMemoryRoomRepository implements RoomRepository
{
    private array $roomCollection;

    public function __construct()
    {
        $this->roomCollection = [];
    }

    public function add(Room $room): void
    {
        $this->roomCollection[$room->getId()] = $room;
    }

    public function get(string $id): Room
    {
         return $this->roomCollection[$id];
    }

}
