<?php

namespace App\Tests\Command\UnbookARoom;

use App\Application\Command\UnbookARoom\UnbookARoomCommand;
use App\Application\Command\UnbookARoom\UnbookARoomCommandHandler;
use App\Domain\Room;
use App\Tests\Command\Repository\InMemoryRoomRepository;
use PHPUnit\Framework\TestCase;

class UnbookARoomTest extends TestCase
{
    public function testThatItUnBookARoom()
    {
        // Given the room 1 is not free
        $roomId = '1';
        $room = Room::create($roomId, false);

        $roomRepository = new InMemoryRoomRepository();

        $roomRepository->add($room);

        // When I unbook the room 1
        $unbookARoomCommand = new UnbookARoomCommand($roomId);
        $unbookARoomCommandHandler = new UnbookARoomCommandHandler($roomRepository);
        $unbookARoomCommandHandler($unbookARoomCommand);

        // Then
        $room = $roomRepository->get($roomId);
        $this->assertTrue($room->isFree());
    }
}
