<?php

namespace App\Application\Command\BookARoomForAPeriodOfTime;

use App\Application\Command\Command;
use App\Domain\Client;

class BookARoomForAPeriodOfTimeCommand implements Command
{
    private string $clientId;

    private string $roomNumber;

    private string $startDate;

    private string $endDate;

    public function __construct(string $clientId, string $roomNumber, string $startDate, string $endDate)
    {
        $this->clientId = $clientId;
        $this->roomNumber = $roomNumber;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getRoomNumber(): string
    {
        return $this->roomNumber;
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function getEndDate(): string
    {
        return $this->endDate;
    }

}
