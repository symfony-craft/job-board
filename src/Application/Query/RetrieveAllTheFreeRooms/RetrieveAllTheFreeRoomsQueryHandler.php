<?php

namespace App\Application\Query\RetrieveAllTheFreeRooms;

use App\Application\Query\Query;
use App\Application\Query\QueryHandler;

class RetrieveAllTheFreeRoomsQueryHandler implements QueryHandler
{
    private SelectAllTheFreeRoomsQuery $selectAllTheFreeRoomsQuery;

    public function __construct(SelectAllTheFreeRoomsQuery $selectAllTheFreeRoomsQuery)
    {
        $this->selectAllTheFreeRoomsQuery = $selectAllTheFreeRoomsQuery;
    }

    public function handle(Query $query): array
    {
        return $this->selectAllTheFreeRoomsQuery->execute();
    }

    public function listenTo(): string
    {
        return RetrieveAllTheFreeRoomsQuery::class;
    }

}
