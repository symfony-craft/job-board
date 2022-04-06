<?php

namespace SymfonyCraft\JobBoard\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCraft\JobBoard\Application\Command\ApplyForTheJob\ApplyForTheJobCommand;
use SymfonyCraft\JobBoard\Application\Command\CommandBus;

#[Route('/apply-for-the-job', name: 'apply-for-the-job', methods: ['POST'])]
class ApplyForTheJobController
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $json = json_decode($request->getContent(), true, flags: JSON_THROW_ON_ERROR);

        $jobId = $json['jobId'];
        $applicantEmail = $json['applicantEmail'];

        $applyForTheJobCommand = new ApplyForTheJobCommand($jobId, $applicantEmail);

        $this->commandBus->dispatch($applyForTheJobCommand);

        return new JsonResponse();
    }

}
