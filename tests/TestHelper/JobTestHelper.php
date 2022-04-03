<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Tests\TestHelper;

final class JobTestHelper
{
    public function __construct(
    ) {
    }

    public function buildJobSnapshotsFromHash(array $jobsHash): array
    {
        return $jobsHash;
    }
}
