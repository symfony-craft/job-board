<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Tests\TestHelper;

final class JobTestHelper
{
    public function __construct(
        private TestHelper $testHelper
    ) {
    }

    public function buildJobSnapshotsMapFromHash(array $jobsHash): array
    {
        return $this->testHelper->toMap($jobsHash, 'id');
    }
}
