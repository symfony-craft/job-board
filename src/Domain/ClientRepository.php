<?php

namespace App\Domain;

interface ClientRepository
{
    public function add(Client $client): void;

    public function get(string $id): Client;
}
