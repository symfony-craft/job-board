<?php

namespace App\Tests\Command\Repository;

use App\Domain\Client;
use App\Domain\ClientRepository;

class InMemoryClientRepository implements ClientRepository
{
    private array $clientStates;

    public function add(Client $client): void
    {
        $clientSate = $client->getState();
        $this->clientStates[$clientSate['id']] = $clientSate;
    }

    public function get(string $clientId): Client
    {
        if(!isset($this->clientStates[$clientId])) {
            dump($this->clientStates);
            throw new \LogicException("This client does not exist");

        }

        return Client::restore($this->clientStates[$clientId]);

    }
}
