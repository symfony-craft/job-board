<?php

namespace App\Infrastructure\Controller;

use App\Application\Command\BookARoomForAPeriodOfTime\BookARoomForAPeriodOfTimeCommand;
use App\Application\Command\CommandBus;
use App\Application\Query\QueryBus;
use App\Application\Query\RetrieveAllTheFreeRooms\RetrieveAllTheFreeRoomsQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @Route("/client/book-a-room", name="book_a_room")
     */
    public function bookARoom(CommandBus $commandBus)
    {
        $bookARoomForAPeriodOfTime = new BookARoomForAPeriodOfTimeCommand('1', '47', '06-06-2021', '10-06-2021');

        $commandBus->dispatch($bookARoomForAPeriodOfTime);

        return new Response(null, Response::HTTP_CREATED);
    }
}
