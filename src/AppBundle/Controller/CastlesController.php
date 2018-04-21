<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CastlesController extends Controller
{
    /**
     *  CastlesCh page
     *
     * @Route("/castles", name="castles")
     * @Template()
     */
    public function indexAction(){
        $repo = $this->get('doctrine')->getManager('game')->getRepository('AppBundle:Castle');
        $castle = $repo->getCastlelist();

        $repo = $this->get('doctrine')->getManager('game')->getRepository('AppBundle:ClanHall');
        $ch = $repo->getChlist();



        return ['castle' => $castle, 'ch' => $ch];
    }



}
