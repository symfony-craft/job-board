<?php

namespace App\Infrastructure\Persistence\Repository;

use App\Domain\Room;
use App\Domain\RoomRepository;

class JsonRoomRepository implements RoomRepository
{

    public function add(Room $room)
    {
        // TODO: Implement add() method.
    }

    public function get(string $number): Room
    {
        return Room::create($number);
    }
}
