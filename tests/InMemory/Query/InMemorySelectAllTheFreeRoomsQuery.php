<?php

namespace App\Tests\InMemory\Query;

use App\Application\Query\RetrieveAllTheFreeRooms\RetrieveAllTheFreeRoomsViewModel;
use App\Application\Query\RetrieveAllTheFreeRooms\SelectAllTheFreeRoomsQuery;
use App\Domain\Room;

class InMemorySelectAllTheFreeRoomsQuery implements SelectAllTheFreeRoomsQuery
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
                $freeRoomViewModels[] = new RetrieveAllTheFreeRoomsViewModel($room['number'], $room['name'], $room['bedNumber'], $room['price']);
            }
         }

         return $freeRoomViewModels;
    }

}
