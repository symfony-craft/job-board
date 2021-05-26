<?php

namespace App\Tests\Query\RetrieveAllTheRooms;

use App\Application\Query\RetrieveAllTheRooms\RetrieveAllTheRoomsQueryHandler;
use App\Application\Query\RetrieveAllTheRooms\RetrieveAllTheRoomsQuery;
use PHPUnit\Framework\TestCase;

class RetrieveAllTheRoomsTest extends TestCase
{
    public function testThatItShouldRetrieveAllTheRooms()
    {
        // Given the rooms 45 and 47 are free
        $roomInformations = [
            [
                'number' => '45',
                'name' => 'La lagune',
                'bedNumber' => 1,
                'price' => 45.50,
                'isFree' => true
            ],
            [
                'number' => '47',
                'name' => 'La vallée',
                'bedNumber' => 2,
                'price' => 90,
                'isFree' => true
            ],
            [
                'number' => '32',
                'name' => 'La montagne',
                'bedNumber' => 4,
                'price' => 120,
                'isFree' => false
            ]
        ];

        // When I retrieve all the free rooms
        $query = new RetrieveAllTheRoomsQuery();
        $selectQuery = new InMemorySelectAllTheRoomsQuery($roomInformations);
        $queryHandler = new RetrieveAllTheRoomsQueryHandler($selectQuery);

        $retrieveAllTheFreeRoomsViewModels = $queryHandler($query);

        // Then I should see the name, number of beds and the price of the rooms 45 and 47
        $expectedRoomIds = ['45', '47', '32'];
        $this->assertContainsRooms($retrieveAllTheFreeRoomsViewModels, $expectedRoomIds);

        foreach ($retrieveAllTheFreeRoomsViewModels as $roomViewModel) {
            foreach ($roomInformations as $roomInformation) {
                if($roomInformation['number'] === $roomViewModel->number) {
                    $this->assertEquals($roomInformation['name'], $roomViewModel->name);
                    $this->assertEquals($roomInformation['bedNumber'], $roomViewModel->bedNumber);
                    $this->assertEquals($roomInformation['price'], $roomViewModel->price);
                    $this->assertEquals($roomInformation['isFree'], $roomViewModel->isFree);

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
