<?php

namespace App\Infrastructure\Persistence\Repository;

use App\Domain\Room;
use App\Domain\RoomRepository;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineRoomRepository implements RoomRepository
{
    private Connection $connection;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->connection = $entityManager->getConnection();
    }

    public function get(string $id): Room
    {
        $roomArray = $this->connection->fetchAssociative('SELECT id, is_free FROM room WHERE id=:roomId', [
            'roomId' => $id
        ]);

        return Room::create($roomArray['id'], $roomArray['is_free']);
    }

    public function add(Room $room): void
    {
        $roomState = $room->getState();
        $this->connection->update('room', [
            'is_free' => $roomState['isFree']
        ], [
            'id' => $roomState['id']
        ]);
    }
}
