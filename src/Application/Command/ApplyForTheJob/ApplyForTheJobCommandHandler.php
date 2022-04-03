<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Application\Command\ApplyForTheJob;

use SymfonyCraft\JobBoard\Application\Command\CommandHandler;
use SymfonyCraft\JobBoard\Domain\Applicant;
use SymfonyCraft\JobBoard\Domain\ApplicantCollection;
use SymfonyCraft\JobBoard\Domain\JobCollection;
use SymfonyCraft\JobBoard\Domain\VO\Email;
use SymfonyCraft\JobBoard\Domain\VO\Identifier;

final class ApplyForTheJobCommandHandler implements CommandHandler
{
    public function __construct(
        private JobCollection $jobCollection,
        private ApplicantCollection $applicantCollection
    ) {
    }

    public function __invoke(ApplyForTheJobCommand $command): void
    {
        $applicantEmail = new Email($command->getApplicantEmail());
        $jobId = new Identifier($command->getJobId());

        $job = $this->jobCollection->get($jobId);
        $applicant = $this->applicantCollection->find($applicantEmail);

        if (null === $applicant) {
            $applicant = Applicant::register($applicantEmail);
        }

        $applicant->apply($job);

        $this->applicantCollection->add($applicant);
    }
}
