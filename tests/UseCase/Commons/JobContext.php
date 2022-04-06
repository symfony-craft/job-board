<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Tests\UseCase\Commons;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use SymfonyCraft\JobBoard\Tests\TestHelper\JobTestHelper;
use SymfonyCraft\JobBoard\Tests\UseCase\Fake\FakeJobCollection;

final class JobContext implements Context
{
    public function __construct(
        private FakeJobCollection $jobCollection,
        private JobTestHelper $jobTestHelper
    ) {
    }

    /**
     * @Given these jobs are registered :
     */
    public function theseJobsAreRegistered(TableNode $table): void
    {
        $jobSnapshotsMap = $this->jobTestHelper->buildJobSnapshotsMapFromHash($table->getHash());
        $this->jobCollection->setFixture($jobSnapshotsMap);
    }
}
