<?php

namespace App\Domain;

class Period
{
    private \DateTime $startDate;
    private \DateTime $endDate;

    private function __construct(string $startDate, string $endDate)
    {
         $startDateDatetime = date_create_from_format('d-m-Y', $startDate);
         $endDateDatetime = date_create_from_format('d-m-Y', $endDate);

         if($startDateDatetime > $endDateDatetime) {
             throw new \LogicException('The start date must be inferior than the end date');
         }

         $this->startDate = $startDateDatetime;
         $this->endDate = $endDateDatetime;
    }

    public static function create(string $startDate, string $endDate): self
    {
        return new Period($startDate, $endDate);
    }

    public function getState(): array
    {
        return [
            'startDate' => $this->startDate->format('d-m-Y'),
            'endDate' => $this->endDate->format('d-m-Y')
        ];
    }
}
