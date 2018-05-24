<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CharacterRepository")
 * @ORM\Table(name="characters")
 *
 */
class Character {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="online", type="integer")
     */
    private $online;

}
