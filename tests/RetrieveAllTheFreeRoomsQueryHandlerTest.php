<?php

namespace App\Tests;

use App\Application\Query\RetrieveAllTheFreeRooms\RetrieveAllTheFreeRoomsQueryHandler;
use App\Application\Query\RetrieveAllTheFreeRooms\RetrieveAllTheFreeRoomsQuery;
use App\Tests\InMemory\Query\InMemorySelectAllTheFreeRoomsQuery;
use PHPUnit\Framework\TestCase;

class RetrieveAllTheFreeRoomsQueryHandlerTest extends TestCase
{
    public function testThatItShouldRetrieveAllTheFreeRooms()
    {
        // Given the rooms 45 and 47 are free
        $roomInformations = [
            [
                'number' => '45',
                'name' => 'La lagune',
                'bedNumber' => 1,
                'price' => 45.50,
                'status' => 'free'
            ],
            [
                'number' => '47',
                'name' => 'La vallée',
                'bedNumber' => 2,
                'price' => 90,
                'status' => 'free'
            ],
            [
                'number' => '32',
                'name' => 'La montagne',
                'bedNumber' => 4,
                'price' => 120,
                'status' => 'occupied'
            ]
        ];

        // When I retrieve all the free rooms
        $query = new RetrieveAllTheFreeRoomsQuery();
        $selectQuery = new InMemorySelectAllTheFreeRoomsQuery($roomInformations);
        $queryHandler = new RetrieveAllTheFreeRoomsQueryHandler($selectQuery);

        $retrieveAllTheFreeRoomsViewModels = $queryHandler->handle($query);

        // Then I should see the name, number of beds and the price of the rooms 45 and 47
        $expectedRoomIds = ['45', '47'];
        $this->assertContainsRooms($retrieveAllTheFreeRoomsViewModels, $expectedRoomIds);

        foreach ($retrieveAllTheFreeRoomsViewModels as $roomViewModel) {
            foreach ($roomInformations as $roomInformation) {
                if($roomInformation['number'] === $roomViewModel->number) {
                    $this->assertEquals($roomInformation['name'], $roomViewModel->name);
                    $this->assertEquals($roomInformation['bedNumber'], $roomViewModel->bedNumber);
                    $this->assertEquals($roomInformation['price'], $roomViewModel->price);

                }
            }
        }

    }

    private function assertContainsRooms($roomCollection, $expectedRoomNumbers)
    {
        $roomCollectionRoomNumbers = [];

        foreach ($roomCollection as $room) {
            $roomCollectionRoomNumbers[] = $room->number;
        }

        $this->assertEquals($expectedRoomNumbers, $roomCollectionRoomNumbers);
    }
}
