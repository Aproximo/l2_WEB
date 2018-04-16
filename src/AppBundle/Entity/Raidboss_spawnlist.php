<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;






/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Raidboss_spawnlistRepository")
 * @ORM\Table(name="raidboss_spawnlist")
 */
class Raidboss_spawnlist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="boss_id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     *
     */
    private $amount;

    /**
     * @ORM\Column(type="integer")
     *
     */
    private $respawn_time;

//    /**
//     *
//     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Npc", mappedBy="idTemplate")
//     */
//    private $npc;

//    public function __construct()
//    {
//        $this->npc = new ArrayCollection();
//    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Get amount
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }




    /**
     * Get respawnTime
     *
     * @return integer
     */
    public function getRespawn_time()
    {
        return $this->respawn_time;
    }


    /**
     * Get npc
     *
     * @return \AppBundle\Entity\Npc
     */
    public function getNpc()
    {
        return $this->npc;
    }
}
