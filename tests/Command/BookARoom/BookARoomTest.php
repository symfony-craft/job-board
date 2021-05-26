<?php

namespace App\Tests\Command\BookARoom;

use App\Application\Command\BookARoom\BookARoomCommand;
use App\Application\Command\BookARoom\BookARoomCommandHandler;
use App\Domain\Room;
use App\Tests\Command\Repository\InMemoryRoomRepository;
use PHPUnit\Framework\TestCase;

class BookARoomTest extends TestCase
{
    public function testThatItShouldBookARoom()
    {
        // Given the room 1 is free
        $roomId = '1';
        $room = Room::create($roomId, true);

        $roomRepository = new InMemoryRoomRepository();

        $roomRepository->add($room);

        // When I book the room 1
        $bookARoomCommand = new BookARoomCommand($roomId);
        $bookARoomCommandHandler = new BookARoomCommandHandler($roomRepository);

        $bookARoomCommandHandler($bookARoomCommand);

        // Then the room 1 should not free anymore
        $room = $roomRepository->get($roomId);
        $this->assertFalse($room->isFree());
    }
}
