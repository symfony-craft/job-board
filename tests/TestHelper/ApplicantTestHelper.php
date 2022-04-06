<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Tests\TestHelper;

final class ApplicantTestHelper
{
    public function __construct(
        private TestHelper $testHelper
    ) {
    }

    public function buildApplicantSnapshotsMapFromHash(array $applicantsHash): array
    {
        $applicantSnapshots = $this->buildApplicantSnapshotsFromHash($applicantsHash);

        return $this->testHelper->toMap($applicantSnapshots, 'email');
    }

    public function buildApplicantSnapshotsFromHash(array $applicantsHash): array
    {
        $applicantSnapshotsMap = [];
        foreach ($applicantsHash as $applicantItem) {
            $applicantItem['applications'] = $this->testHelper->stringToArray($applicantItem['applications']);
            $applicantSnapshotsMap[] = $applicantItem;
        }

        return $applicantSnapshotsMap;
    }
}
