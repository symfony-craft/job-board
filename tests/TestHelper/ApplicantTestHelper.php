<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Tests\TestHelper;

final class ApplicantTestHelper
{
    public function __construct(
        private TestHelper $testHelper
    ) {
    }

    public function buildApplicantSnapshotsFromHash(array $applicantsHash): array
    {
        $applicantSnapshots = [];
        foreach ($applicantsHash as $applicantItem) {
            $applicantItem['applications'] = $this->testHelper->stringToArray($applicantItem['applications']);
            $applicantSnapshots[] = $applicantItem;
        }

        return $applicantSnapshots;
    }
}
