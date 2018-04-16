<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CastlesChController extends Controller
{
    /**
     *  CastlesCh page
     *
     * @Route("/castels", name="CastlesCh_list")
     * @Template()
     */
    public function indexAction(){
        $repo = $this->get('doctrine')->getRepository('AppBundle:Castle');
        $castle = $repo->getCastlelist();

        $repo = $this->get('doctrine')->getRepository('AppBundle:ClanHall');
        $ch = $repo->getChlist();



        return ['castle' => $castle, 'ch' => $ch];
    }



}
