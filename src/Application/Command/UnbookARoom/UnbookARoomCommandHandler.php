<?php

namespace App\Application\Command\UnbookARoom;

use App\Application\Command\CommandHandler;
use App\Domain\RoomRepository;

class UnbookARoomCommandHandler implements CommandHandler
{
    private RoomRepository $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function __invoke(UnbookARoomCommand $command)
    {
        $room = $this->roomRepository->get($command->getRoomId());

        $room->unbook();

        $this->roomRepository->add($room);
    }

}
