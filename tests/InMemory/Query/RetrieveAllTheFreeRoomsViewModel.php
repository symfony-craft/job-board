<?php

namespace App\Tests\InMemory\Query;

class RetrieveAllTheFreeRoomsViewModel
{
    public string $number;
    public string $name;
    public int $bedNumber;
    public float $price;

    public function __construct(string $number, string $name, int $bedNumber, float $price)
    {
        $this->number = $number;
        $this->name = $name;
        $this->bedNumber = $bedNumber;
        $this->price = $price;
    }

}
