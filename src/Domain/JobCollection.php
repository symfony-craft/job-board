<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Domain;

use SymfonyCraft\JobBoard\Domain\VO\Identifier;

interface JobCollection
{
    public function get(Identifier $id): Job;
}
