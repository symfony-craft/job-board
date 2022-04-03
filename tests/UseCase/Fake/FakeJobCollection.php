<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Tests\UseCase\Fake;

use SymfonyCraft\JobBoard\Domain\Job;
use SymfonyCraft\JobBoard\Domain\JobCollection;
use SymfonyCraft\JobBoard\Domain\VO\Identifier;

final class FakeJobCollection implements JobCollection
{
    private array $jobSnapshots = [];

    public function get(Identifier $id): Job
    {
        foreach ($this->jobSnapshots as $jobSnapshot) {
            if ($jobSnapshot['id'] === $id->get()) {
                return Job::fromSnapshot($jobSnapshot);
            }
        }

        throw new \LogicException(sprintf('The job was not found for the id %s', $id->get()));
    }

    public function setFixture(array $jobSnapshots): void
    {
        $this->jobSnapshots = $jobSnapshots;
    }
}
