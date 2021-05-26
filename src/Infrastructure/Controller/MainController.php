<?php

namespace App\Infrastructure\Controller;

use App\Application\Command\BookARoom\BookARoomCommand;
use App\Application\Command\CommandBus;
use App\Application\Command\UnbookARoom\UnbookARoomCommand;
use App\Application\Query\QueryBus;
use App\Application\Query\RetrieveAllTheRooms\RetrieveAllTheRoomsQuery;
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
        $rooms = $queryBus->handle(new RetrieveAllTheRoomsQuery());

        return $this->render('main/index.html.twig', [
            'rooms' => $rooms
        ]);
    }

    /**
     * @Route("/book-the-room/{roomId}", name="book_the_room")
     */
    public function bookTheRoom(string $roomId, CommandBus $commandBus)
    {
        $bookARoomCommand = new BookARoomCommand($roomId);

        $commandBus->dispatch($bookARoomCommand);

        return $this->redirectToRoute('index');
    }

    /**
     * @Route("/unbook-the-room/{roomId}", name="unbook_the_room")
     */
    public function unbookTheRoom(string $roomId, CommandBus $commandBus)
    {
        $unbookARoomCommand = new UnbookARoomCommand($roomId);

        $commandBus->dispatch($unbookARoomCommand);

        return $this->redirectToRoute('index');
    }
}
