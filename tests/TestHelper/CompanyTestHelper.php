<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Tests\TestHelper;

final class CompanyTestHelper
{
    public function buildCompanySnapshotsFromHash(array $companiesHash): array
    {
        // Here, the hash is the same as the snapshot, but most of the time we need to sanitize the behat hash
        return $companiesHash;
    }
}
