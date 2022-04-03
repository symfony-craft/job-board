<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Application\Command\ApplyForTheJob;

use SymfonyCraft\JobBoard\Application\Command\Command;

final class ApplyForTheJobCommand implements Command
{
    public function __construct(
        private string $jobId,
        private string $applicantEmail)
    {
    }

    public function getJobId(): string
    {
        return $this->jobId;
    }

    public function getApplicantEmail(): string
    {
        return $this->applicantEmail;
    }
}
