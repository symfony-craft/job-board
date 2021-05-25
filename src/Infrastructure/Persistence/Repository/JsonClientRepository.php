<?php

namespace App\Infrastructure\Persistence\Repository;

use App\Domain\Client;
use App\Domain\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class JsonClientRepository implements ClientRepository
{
    private string $filePath;
    private array $clientStates;

    public function __construct(KernelInterface $kernel)
    {
        $this->filePath = $kernel->getProjectDir().'/JsonDB/Clients.json';

        $this->retrieveClientStates();
    }

    public function add(Client $client): void
    {
        $clientState = $client->getState();

        $this->clientStates[$clientState['id']] = $clientState;

        $this->flushClientStates();
    }

    public function get(string $id): Client
    {
        if(!isset($this->clientStates[$id])) {
            $this->clientStates[$id] = Client::create($id, 'Raymond', 'Dupont')->getState();
            $this->flushClientStates();
            throw new \LogicException("This client does not exist");
        }

        return Client::restore($this->clientStates[$id]);
    }

    private function retrieveClientStates(): void {
        $jsonClientStates = file_get_contents($this->filePath);
        $this->clientStates = json_decode($jsonClientStates, true);
    }

    private function flushClientStates(): void {
        $jsonClientStates = json_encode($this->clientStates);

        file_put_contents($this->filePath, $jsonClientStates);
    }
}
