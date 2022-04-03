<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Tests\UseCase\Commons;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use SymfonyCraft\JobBoard\Tests\TestHelper\CompanyTestHelper;
use SymfonyCraft\JobBoard\Tests\UseCase\Fake\FakeCompanyCollection;

final class CompanyContext implements Context
{
    public function __construct(
        private FakeCompanyCollection $companyCollection,
        private CompanyTestHelper $companyTestHelper,
    ) {
    }

    /**
     * @Given these companies are registered :
     */
    public function theseCompanyAreRegistered(TableNode $table): void
    {
        $companySnapshots = $this->companyTestHelper->buildCompanySnapshotsFromHash($table->getHash());
        $this->companyCollection->setFixture($companySnapshots);
    }
}
