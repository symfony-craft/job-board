<?php

namespace App\Tests\Command\Repository;

use App\Domain\Number;
use App\Domain\Room;
use App\Domain\RoomRepository;

class InMemoryRoomRepository implements RoomRepository
{

    public function __construct()
    {
    }

    public function add(Room $room)
    {
    }

    public function get(Number $create): Room
    {
        return Room::create('47');
    }

}
