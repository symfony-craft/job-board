<?php

namespace App\Application\Query\RetrieveAllTheFreeRooms;

interface SelectAllTheFreeRoomsQuery
{
    public function execute(): array;
}
