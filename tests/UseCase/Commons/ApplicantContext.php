<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Tests\UseCase\Commons;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use SymfonyCraft\JobBoard\Tests\TestHelper\ApplicantTestHelper;
use SymfonyCraft\JobBoard\Tests\UseCase\Fake\FakeApplicantCollection;

final class ApplicantContext implements Context
{
    public function __construct(
        private FakeApplicantCollection $applicantCollection,
        private ApplicantTestHelper $applicantTestHelper
    ) {
    }

    /**
     * @Then these applicants should be registered :
     */
    public function theseApplicantsShouldBeRegistered(TableNode $table): void
    {
        $expectedApplicantSnapshots = $this->applicantTestHelper->buildApplicantSnapshotsFromHash($table->getHash());
        $applicantSnapshots = $this->applicantCollection->getSnapshots();

        if ($expectedApplicantSnapshots !== $applicantSnapshots) {
            throw new \Exception('Snapshots are not equals');
        }
    }
}
