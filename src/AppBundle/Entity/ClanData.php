<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;






/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClanDataRepository")
 * @ORM\Table(name="clan_data")
 *
 */
class ClanData
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="clan_id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="clan_name", type="string")
     *
     */
    private $name;


    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Castle", inversedBy="clanId")
     * @JoinColumn(name="hasCastle", referencedColumnName="id")
     */
    private $castle;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\ClanHall", mappedBy="clanId")
     *
     */
    private $chId;


    /**
     * Get idTemplate
     *
     * @return \AppBundle\Entity\Castle
     */
    public function getCastle()
    {
        return $this->castle;
    }

    /**
     * Get idTemplate
     *
     * @return \AppBundle\Entity\ClanHall
     */
    public function getChId()
    {
        return $this->chId;
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




}
