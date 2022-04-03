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
        $this->applications[] = $job->getId();
    }

    /**
     * @phpstan-return ApplicantSnapshot
     */
    public function toSnapshot(): array
    {
        return [
            'email' => $this->email->get(),
            'applications' => array_map(fn (Identifier $jobId) => $jobId->get(), $this->applications),
        ];
    }
}
