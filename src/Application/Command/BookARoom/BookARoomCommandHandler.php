<?php

namespace App\Application\Command\BookARoom;

use App\Application\Command\CommandHandler;
use App\Application\Event\EventBus;
use App\Application\Event\RoomBooked\RoomBookedEvent;
use App\Domain\RoomRepository;

class BookARoomCommandHandler implements CommandHandler
{
    private RoomRepository $roomRepository;
    private EventBus $eventBus;

    public function __construct(RoomRepository $roomRepository, EventBus $eventBus)
    {
        $this->roomRepository = $roomRepository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(BookARoomCommand $command): void
    {
        $room = $this->roomRepository->get($command->getRoomId());

        $room->book();

        $this->roomRepository->add($room);

        $this->eventBus->dispatch(new RoomBookedEvent($room->getId()));
    }

}
