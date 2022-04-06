<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Tests\UseCase\Fake;

use SymfonyCraft\JobBoard\Domain\Job;
use SymfonyCraft\JobBoard\Domain\JobCollection;
use SymfonyCraft\JobBoard\Domain\VO\Identifier;

final class FakeJobCollection implements JobCollection
{
    private array $jobSnapshotsMap = [];

    public function get(Identifier $id): Job
    {
        if (isset($this->jobSnapshotsMap[$id->get()])) {
            return Job::fromSnapshot($this->jobSnapshotsMap[$id->get()]);
        }

        throw new \LogicException(sprintf('The job was not found for the id %s', $id->get()));
    }

    public function setFixture(array $jobSnapshotsMap): void
    {
        $this->jobSnapshotsMap = $jobSnapshotsMap;
    }
}
