<?php

namespace App\Domain;

class Booking
{
    private Room $room;

    private Period $period;

    private function __construct(Room $room, Period $period)
    {
        $this->room = $room;
        $this->period = $period;
    }

    public static function create(Room $room, Period $period): Booking
    {
        return new Booking($room, $period);
    }

    public function getState(): array
    {
        return [
            'room' => $this->room->getState(),
            'period' => $this->period->getState(),
        ];
    }

}
