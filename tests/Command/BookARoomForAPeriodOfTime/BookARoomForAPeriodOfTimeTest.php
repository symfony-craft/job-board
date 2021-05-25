<?php

namespace App\Tests\Command\BookARoomForAPeriodOfTime;

use App\Application\Command\BookARoomForAPeriodOfTime\BookARoomForAPeriodOfTimeCommand;
use App\Application\Command\BookARoomForAPeriodOfTime\BookARoomForAPeriodOfTimeCommandHandler;
use App\Domain\Client;
use App\Domain\Number;
use App\Domain\Period;
use App\Domain\Room;
use App\Tests\Command\Repository\InMemoryClientRepository;
use App\Tests\Command\Repository\InMemoryRoomRepository;
use PHPUnit\Framework\TestCase;

class BookARoomForAPeriodOfTimeTest extends TestCase
{
    public function testThatItShouldBookAPeriodOfTime()
    {
        // The client Roger Dupont exist
        // Given the room 47 is free between the 04-06-2021 and the 11-06-2021
        $clientRepository = new InMemoryClientRepository();

        $clientId = '1';

        $room = Room::create('47');
        $client = Client::create($clientId, 'Roger', 'Dupont');

        $roomRepository = new InMemoryRoomRepository();

        $roomRepository->add($room);
        $clientRepository->add($client);

        // When I book the room from the 04-06-2021 to the 11-06-2021
        $bookARoomForAPeriodOfTimeCommand = new BookARoomForAPeriodOfTimeCommand($clientId, '47', '04-06-2021', '11-06-2021');

        $bookARoomForAPeriodOfTimeCommandHandler = new BookARoomForAPeriodOfTimeCommandHandler($roomRepository, $clientRepository);

        $bookARoomForAPeriodOfTimeCommandHandler($bookARoomForAPeriodOfTimeCommand);

        // Then the room 47 should be occupied during the 04-06-2021 to the 11-06-2021
        $client = $clientRepository->get($clientId);

        $expectedClient = Client::restore([
            'id' => '1',
            'firstname' => 'Roger',
            'lastname' => 'Dupont',
            'bookings' => [
                [
                    'room' => [
                        'number' => '47'
                    ],
                    'period' => [
                        'startDate' => '04-06-2021',
                        'endDate' => '11-06-2021'
                    ],

                ]
            ]
        ]);

        $this->assertEquals($expectedClient, $client);
    }

}
