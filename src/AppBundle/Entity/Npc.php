<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;






/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\npcRepository")
 * @ORM\Table(name="npc")
 *
 */
class Npc
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
     * @ORM\Column(type="string")
     *
     */
    private $title;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Raidboss_spawnlist", inversedBy="Npc")
     * @JoinColumn(name="idTemplate", referencedColumnName="boss_id")
     */
    private $idTemplate;


    /**
     * Get idTemplate
     *
     * @return \AppBundle\Entity\Raidboss_spawnlist
     */
    public function getIdTemplate()
    {
        return $this->idTemplate;
    }


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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }


}
