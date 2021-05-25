<?php

namespace App\Application\Command\BookARoomForAPeriodOfTime;

use App\Application\Command\CommandHandler;
use App\Domain\ClientRepository;
use App\Domain\Period;
use App\Domain\RoomRepository;

class BookARoomForAPeriodOfTimeCommandHandler implements CommandHandler
{

    private RoomRepository $roomRepository;
    private ClientRepository $clientRepository;

    public function __construct(RoomRepository $roomRepository, ClientRepository $clientRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->clientRepository = $clientRepository;
    }

    public function __invoke(BookARoomForAPeriodOfTimeCommand $command)
    {
        $room = $this->roomRepository->get($command->getRoomNumber());

        $period = Period::create($command->getStartDate(), $command->getEndDate());

        $client = $this->clientRepository->get($command->getClientId());

        $client->book($room, $period);

        $this->clientRepository->add($client);
    }

}
