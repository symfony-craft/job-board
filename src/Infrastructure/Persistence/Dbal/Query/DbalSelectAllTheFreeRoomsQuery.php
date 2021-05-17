<?php

namespace App\Infrastructure\Persistence\Dbal\Query;

use App\Application\Query\RetrieveAllTheFreeRooms\RetrieveAllTheFreeRoomsViewModel;
use App\Application\Query\RetrieveAllTheFreeRooms\SelectAllTheFreeRoomsQuery;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;

class DbalSelectAllTheFreeRoomsQuery implements SelectAllTheFreeRoomsQuery
{
    private Connection $connection;

    public function __construct(EntityManagerInterface $em)
    {
        $this->connection = $em->getConnection();
    }

    public function execute(): array
    {
        $rawRooms = $this->connection->executeQuery('SELECT number, name, bed_number, price FROM room r WHERE r.status = \'free\'')->fetchAllAssociative();

        $roomViewModels = [];
        foreach ($rawRooms as $rawRoom) {
            $roomViewModels[] = new RetrieveAllTheFreeRoomsViewModel($rawRoom['number'], $rawRoom['name'], $rawRoom['bed_number'], $rawRoom['price']);
        }

        return $roomViewModels;
    }

}
