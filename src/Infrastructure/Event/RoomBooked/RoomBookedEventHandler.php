<?php

namespace App\Infrastructure\Event\RoomBooked;

use App\Application\Event\EventHandler;
use App\Application\Event\RoomBooked\RoomBookedEvent;

class RoomBookedEventHandler implements EventHandler
{

    public function __construct()
    {
    }

    public function __invoke(RoomBookedEvent $event)
    {
        // send a mail, write some projection, calcul some fields in async
        dump($event);
    }

}
