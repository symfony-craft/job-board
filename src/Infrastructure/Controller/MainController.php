<?php

namespace App\Infrastructure\Controller;

use App\Application\Query\QueryBus;
use App\Application\Query\RetrieveAllTheFreeRooms\RetrieveAllTheFreeRoomsQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(QueryBus $queryBus)
    {
        return $this->json($queryBus->handle(new RetrieveAllTheFreeRoomsQuery()));
    }
}
