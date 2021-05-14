<?php

namespace App\Domain;

class Room
{
    private Status $status;

    private function __construct(Status $status)
    {
        $this->status = $status;
    }

    public static function create(string $number, string $name, int $bedNumber, float $price, string $status): self
    {
        return new Room(Status::create($status));
    }

    public function isFree()
    {
        return $this->status->equal(Status::create('free'));
    }
}
