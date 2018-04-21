<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RaidBossesController extends Controller
{
    /**
     *  RaidBosses page
     *
     * @Route("/raidbosses", name="raidbosses")
     * @Template()
     */
    public function indexAction(){
        $repo = $this->get('doctrine')->getManager('game')->getRepository('AppBundle:Raidboss_spawnlist');
        $rb = $repo->getRBlist();

        return compact('rb');
    }

    /**
     * RaidBosses page
     * sl - for tralling slash if its needed
     *
     * @Route("/raidbosses/{id}{sl}", name="raid_boss", defaults={"sl" : ""}, requirements={"id" : "[1-9][0-9]*","sl":"/?"})
     * @Template()
     */
    public function showAction($id){
        $repo = $this->get('doctrine')->getRepository('AppBundle:Raidboss_spawnlist');
        $rb = $repo->find($id);

        if(!$rb){
            throw $this -> createNotFoundException('Wrong RB id');
        }

        return compact('rb');
    }




}
