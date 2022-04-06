<?php

namespace SymfonyCraft\JobBoard\Infrastructure\Persistence\InMemory;

use SymfonyCraft\JobBoard\Domain\Job;
use SymfonyCraft\JobBoard\Domain\JobCollection;
use SymfonyCraft\JobBoard\Domain\VO\Identifier;

class InMemoryJobCollection implements JobCollection
{
    private array $jobSnapshotsMap = [];

    public function __construct()
    {
        $this->jobSnapshotsMap = [
            "1" => [
                'id' => '1',
                'title' => 'Symfony job'
            ]
        ];
    }

    public function get(Identifier $id): Job
    {
        if(isset($this->jobSnapshotsMap[$id->get()])) {
            return Job::fromSnapshot($this->jobSnapshotsMap[$id->get()]);
        }

        throw new \LogicException(sprintf('The job was not found for the id %s', $id->get()));
    }

}
