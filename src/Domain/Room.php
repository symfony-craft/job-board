<?php

namespace App\Domain;

class Room
{
    protected string $number;

    private function __construct(string $number)
    {
        $this->number = $number;
    }

    public static function create(string $number): self
    {
        return new Room($number);
    }

    public function getState(): array
    {
        return [
            'number' => $this->number
        ];
    }

}
