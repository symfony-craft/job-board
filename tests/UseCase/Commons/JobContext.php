<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Tests\UseCase\Commons;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;

final class JobContext implements Context
{
    /**
     * @Given these jobs exist :
     */
    public function theseJobsExist(TableNode $table): void
    {
        throw new PendingException();
    }
}
