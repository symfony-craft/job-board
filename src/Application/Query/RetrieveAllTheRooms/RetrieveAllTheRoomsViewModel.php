<?php

namespace App\Application\Query\RetrieveAllTheRooms;

class RetrieveAllTheRoomsViewModel
{
    public string $id;
    public string $name;
    public bool $isFree;

    public function __construct(string $id, string $name, bool $isFree)
    {
        $this->id = $id;
        $this->name = $name;
        $this->isFree = $isFree;
    }

}
