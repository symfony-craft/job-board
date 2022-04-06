<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Domain;

use SymfonyCraft\JobBoard\Domain\VO\Email;
use SymfonyCraft\JobBoard\Domain\VO\Identifier;

/**
 * @phpstan-type ApplicantSnapshot array{
 *    email: string,
 *    applications: array<string>
 * }
 */
final class Applicant
{
    /**
     * @var array<Identifier>
     */
    private array $applications;

    public function __construct(
        private Email $email)
    {
        $this->applications = [];
    }

    public static function register(Email $email): self
    {
        return new self($email);
    }

    public function apply(Job $job): void
    {
        if (in_array($job->getId(), $this->applications)) {
            return;
        }

        $this->applications[] = $job->getId();
    }

    public static function fromSnapshot(array $applicantSnapshot): self
    {
        $applicant = new self(new Email($applicantSnapshot['email']));
        $jobIdentifiers = array_map(fn (string $jobId) => new Identifier($jobId), $applicantSnapshot['applications']);
        $applicant->applications = $jobIdentifiers;

        return $applicant;
    }

    /**
     * @phpstan-return ApplicantSnapshot
     */
    public function toSnapshot(): array
    {
        $jobIds = array_map(fn (Identifier $jobId) => $jobId->get(), $this->applications);

        return [
            'email' => $this->email->get(),
            'applications' => $jobIds,
        ];
    }
}
