<?php

namespace SymfonyCraft\JobBoard\Tests\UseCase\Commons;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;

class JobContext implements Context
{

    /**
     * @Given these jobs exist :
     */
    public function theseJobsExist(TableNode $table)
    {
        throw new PendingException();
    }
}
