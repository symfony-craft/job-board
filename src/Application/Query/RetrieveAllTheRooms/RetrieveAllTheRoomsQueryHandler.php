<?php

namespace App\Application\Query\RetrieveAllTheRooms;

use App\Application\Query\Query;
use App\Application\Query\QueryHandler;

class RetrieveAllTheRoomsQueryHandler implements QueryHandler
{
    private SelectAllTheRoomsQuery $selectAllTheRoomsQuery;

    public function __construct(SelectAllTheRoomsQuery $selectAllTheRoomsQuery)
    {
        $this->selectAllTheRoomsQuery = $selectAllTheRoomsQuery;
    }

    public function __invoke(Query $query): array
    {
        return $this->selectAllTheRoomsQuery->execute();
    }
}
