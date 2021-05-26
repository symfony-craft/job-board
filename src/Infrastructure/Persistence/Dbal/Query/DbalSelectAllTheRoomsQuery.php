<?php

namespace App\Infrastructure\Persistence\Dbal\Query;

use App\Application\Query\RetrieveAllTheRooms\RetrieveAllTheRoomsViewModel;
use App\Application\Query\RetrieveAllTheRooms\SelectAllTheRoomsQuery;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;

class DbalSelectAllTheRoomsQuery implements SelectAllTheRoomsQuery
{
    private Connection $connection;

    public function __construct(EntityManagerInterface $em)
    {
        $this->connection = $em->getConnection();
    }

    public function execute(): array
    {
        $rawRooms = $this->connection->executeQuery('SELECT id, name, is_free FROM room r')->fetchAllAssociative();

        $roomViewModels = [];
        foreach ($rawRooms as $rawRoom) {
            $roomViewModels[] = new RetrieveAllTheRoomsViewModel($rawRoom['id'], $rawRoom['name'], $rawRoom['is_free']);
        }

        return $roomViewModels;
    }

}
