<?php

namespace App\Application\Query\RetrieveAllTheFreeRooms;

use App\Application\Query\Query;
use App\Application\Query\QueryHandler;

class RetrieveAllTheRoomsQueryHandler implements QueryHandler
{
    private SelectAllTheRoomsQuery $selectAllTheFreeRoomsQuery;

    public function __construct(SelectAllTheRoomsQuery $selectAllTheFreeRoomsQuery)
    {
        $this->selectAllTheFreeRoomsQuery = $selectAllTheFreeRoomsQuery;
    }

    public function __invoke(Query $query): array
    {
        return $this->selectAllTheFreeRoomsQuery->execute();
    }
}
