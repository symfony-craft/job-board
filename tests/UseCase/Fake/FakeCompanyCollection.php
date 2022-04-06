<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Tests\UseCase\Fake;

use SymfonyCraft\JobBoard\Domain\CompanyCollection;

final class FakeCompanyCollection implements CompanyCollection
{
    public function setFixture(array $companySnapshotsMap): void
    {
    }
}
