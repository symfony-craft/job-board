<?php

declare(strict_types=1);

namespace App\Domain;

class Client
{
    private string $id;
    private string $firstname;
    private string $lastname;
    private array $bookings;

    private function __construct(string $id, string $firstname, string $lastname)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->bookings = [];
    }

    public static function create(string $id, string $firstname, string $lastname): self
    {
        return new Client($id, $firstname, $lastname);
    }

    public function book(Room $room, Period $period)
    {
        $this->bookings[] = Booking::create($room, $period);
    }

    public function getState()
    {
        $bookingsToString = [];

        foreach ($this->bookings as $booking) {
            $bookingsToString[] = $booking->getState();
        }

        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'bookings' => $bookingsToString
        ];
    }

    public static function restore($clientState): Client
    {
        $client = new Client($clientState['id'], $clientState['firstname'], $clientState['lastname']);

        foreach ($clientState['bookings'] as $booking) {
            $client->bookings[] = Booking::create(Room::create($booking['room']['number']), Period::create($booking['period']['startDate'], $booking['period']['endDate']));
        }

        return $client;
    }
}
