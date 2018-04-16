<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;






/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\npcRepository")
 * @ORM\Table(name="l2web.raidboss_name")
 *
 */
class Rb_name
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Raidboss_spawnlist", inversedBy="name")
     * @JoinColumn(name="boss_id", referencedColumnName="boss_id")
     */
    private $rb_id;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getRbId()
    {
        return $this->rb_id;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


}
