<?php

namespace App\Infrastructure\Controller;

use App\Application\Query\RetrieveAllTheFreeRooms\RetrieveAllTheFreeRoomsQuery;
use App\Infrastructure\BusDispatcher\QueryBusDispatcher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(QueryBusDispatcher $queryBusDispatcher)
    {
        return $this->json($queryBusDispatcher->dispatch(new RetrieveAllTheFreeRoomsQuery()));
    }
}
