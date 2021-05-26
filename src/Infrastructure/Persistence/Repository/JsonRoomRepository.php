<?php

namespace App\Infrastructure\Persistence\Repository;

use App\Domain\Room;
use App\Domain\RoomRepository;
use Symfony\Component\HttpKernel\KernelInterface;

class JsonRoomRepository
{

    private string $filePath;
    private array $roomStates;

    public function __construct(KernelInterface $kernel)
    {
        $this->filePath = $kernel->getProjectDir().'/JsonDB/Rooms.json';

        $this->retrieveRoomStates();
    }

    public function add(Room $room): void
    {
        $roomState = $room->getState();

        $this->roomStates[$roomState['id']] = $roomState;

        $this->flushRoomStates();
    }

    public function get(string $id): Room
    {
        if(!isset($this->roomStates[$id])) {
            $this->roomStates[$id] = Room::create($id, true)->getState();
            $this->flushRoomStates();
            throw new \LogicException("This room does not exist");
        }

        return Room::restore($this->roomStates[$id]);
    }

    private function retrieveRoomStates(): void {
        $jsonRoomStates = file_get_contents($this->filePath);
        $this->roomStates = json_decode($jsonRoomStates, true);
    }

    private function flushRoomStates(): void {
        $jsonRoomStates = json_encode($this->roomStates);

        file_put_contents($this->filePath, $jsonRoomStates);
    }
}
