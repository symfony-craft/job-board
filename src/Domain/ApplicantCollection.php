<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Domain;

use SymfonyCraft\JobBoard\Domain\VO\Email;

interface ApplicantCollection
{
    public function find(Email $email): ?Applicant;

    public function add(Applicant $applicant): void;
}
