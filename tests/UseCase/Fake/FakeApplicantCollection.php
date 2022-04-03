<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Tests\UseCase\Fake;

use SymfonyCraft\JobBoard\Domain\Applicant;
use SymfonyCraft\JobBoard\Domain\ApplicantCollection;
use SymfonyCraft\JobBoard\Domain\VO\Email;

final class FakeApplicantCollection implements ApplicantCollection
{
    private array $applicantSnapshotsMap = [];

    public function find(Email $email): ?Applicant
    {
        return null;
    }

    public function add(Applicant $applicant): void
    {
        $applicantSnapshot = $applicant->toSnapshot();
        $this->applicantSnapshotsMap[$applicantSnapshot['email']] = $applicantSnapshot;
    }

    public function getSnapshots(): array
    {
        return array_values($this->applicantSnapshotsMap);
    }
}
