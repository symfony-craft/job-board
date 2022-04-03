<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Domain;

use SymfonyCraft\JobBoard\Domain\VO\Identifier;

/**
 * @phpstan-type JobSnapshot array{
 *   id: string
 * }
 */
final class Job
{
    public function __construct(
        private Identifier $id,
    ) {
    }

    /**
     * @phpstan-param JobSnapshot $jobSnapshot
     */
    public static function fromSnapshot(array $jobSnapshot): self
    {
        return new self(new Identifier($jobSnapshot['id']));
    }

    public function getId(): Identifier
    {
        return $this->id;
    }
}
