<?php

namespace App\Domain;

class Status
{
    private const FREE = 'free';
    private const OCCUPIED = 'occupied';
    private const ALL = [
      self::FREE,
      self::OCCUPIED
    ];
    private string $name;

    public function __construct(string $name)
    {
        if(!in_array($name, self::ALL)) {
            throw new \LogicException('Status can only take the value free or occupied');
        }
        $this->name = $name;
    }

    public static function create(string $status)
    {
        return new Status($status);
    }

    public function equal(Status $status)
    {
        return $this->name === $status->name;
    }
}
