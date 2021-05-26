<?php

namespace App\Domain;

interface RoomRepository
{
    public function get(string $id): Room;

    public function add(Room $room): void;
}
