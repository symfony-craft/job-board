<?php

namespace App\Infrastructure\Controller;

use App\Application\Command\TestCommand\TestCommand;
use App\Infrastructure\CommandBus\CommandBusDispatcher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(CommandBusDispatcher $commandBusDispatcher)
    {
        $testCommand = new TestCommand();
        $testCommand->message = "Hello World !";

        return $this->json([
            'TestCommand' => $commandBusDispatcher->dispatch($testCommand)
        ]);
    }
}
