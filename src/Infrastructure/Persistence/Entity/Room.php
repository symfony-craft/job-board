<?php

namespace App\Infrastructure\Persistence\Entity;

use App\Infrastructure\Persistence\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Room
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $number;

    /**
     * @ORM\Column(type="integer")
     */
    public $bedNumber;

    /**
     * @ORM\Column(type="float")
     */
    public $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $status;

}
