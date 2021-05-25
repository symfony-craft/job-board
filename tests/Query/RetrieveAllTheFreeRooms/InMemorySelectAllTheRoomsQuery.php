<?php

namespace App\Tests\Query\RetrieveAllTheFreeRooms;

use App\Application\Query\RetrieveAllTheFreeRooms\RetrieveAllTheRoomsViewModel;
use App\Application\Query\RetrieveAllTheFreeRooms\SelectAllTheRoomsQuery;

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
            if($room['status'] === 'free') {
                $freeRoomViewModels[] = new RetrieveAllTheRoomsViewModel($room['number'], $room['name'], $room['bedNumber'], $room['price']);
            }
         }

         return $freeRoomViewModels;
    }

}
