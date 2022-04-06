<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return new JsonResponse(['salut' => 'hey']);
    }
}
