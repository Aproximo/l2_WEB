<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;






/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CastleRepository")
 * @ORM\Table(name="castle")
 *
 */
class Castle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string")
     *
     */
    private $name;


    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\ClanData", mappedBy="castle")
     *
     */
    private $clanId;


    /**
     * Get idTemplate
     *
     * @return \AppBundle\Entity\ClanData
     */
    public function getClanId()
    {
        return $this->clanId;
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
