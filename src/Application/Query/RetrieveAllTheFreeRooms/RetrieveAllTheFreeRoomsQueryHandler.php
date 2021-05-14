<?php

namespace App\Application\Query\RetrieveAllTheFreeRooms;

class RetrieveAllTheFreeRoomsQueryHandler
{
    private SelectAllTheFreeRoomsQuery $selectAllTheFreeRoomsQuery;

    public function __construct(SelectAllTheFreeRoomsQuery $selectAllTheFreeRoomsQuery)
    {
        $this->selectAllTheFreeRoomsQuery = $selectAllTheFreeRoomsQuery;
    }

    public function handle(RetrieveAllTheFreeRoomsQuery $query): array
    {
        return $this->selectAllTheFreeRoomsQuery->execute();
    }
}
