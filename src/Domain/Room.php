<?php

declare(strict_types=1);

namespace App\Domain;

class Room
{
    private string $id;
    private bool $isFree;

    private function __construct() {}

    public static function create(string $roomId, bool $true): self
    {
        $room = new Room();
        $room->id = $roomId;
        $room->isFree = $true;

        return $room;
    }

    public function getId()
    {
        return $this->id;
    }

    public function isFree()
    {
        return $this->isFree;
    }

    public function book(): void
    {
        $this->isFree = false;
    }

    public function unbook()
    {
        $this->isFree = true;
    }

    public function getState(): array
    {
        return [
            'id' => $this->id,
            'isFree' => $this->isFree ? 1 : 0
        ];
    }

    public function restore(array $state): self
    {
        $room = new Room();
        $room->id = $state['id'];
        $room->isFree = $state['isFree'] ? true : false;

        return $room;
    }

}
