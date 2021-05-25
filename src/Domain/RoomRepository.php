<?php

namespace App\Domain;

interface RoomRepository
{
    public function add(Room $room);

    public function get(string $number): Room;
}
