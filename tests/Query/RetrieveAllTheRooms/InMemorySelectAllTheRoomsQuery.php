<?php

namespace App\Tests\Query\RetrieveAllTheRooms;

use App\Application\Query\RetrieveAllTheRooms\RetrieveAllTheRoomsViewModel;
use App\Application\Query\RetrieveAllTheRooms\SelectAllTheRoomsQuery;

class InMemorySelectAllTheRoomsQuery implements SelectAllTheRoomsQuery
{

    public array $roomCollection;

    public function __construct(array $roomCollection)
    {
        $this->roomCollection = $roomCollection;
    }

    public function execute(): array
    {
        $freeRoomViewModels = [];

        foreach ($this->roomCollection as $room) {
                $freeRoomViewModels[] = new RetrieveAllTheRoomsViewModel($room['number'], $room['name'], $room['bedNumber'], $room['price'], $room['isFree']);
        }

        return $freeRoomViewModels;
    }

}
