<?php

namespace App\Infrastructure\Persistence\Dbal\Query;

use App\Application\Query\RetrieveAllTheFreeRooms\SelectAllTheFreeRoomsQuery;

class DbalSelectAllTheFreeRoomsQuery implements SelectAllTheFreeRoomsQuery
{
    public function execute(): array
    {
         return [];
    }

}
