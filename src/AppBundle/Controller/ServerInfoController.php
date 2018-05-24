<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ServerInfoController extends Controller {


  /**
   *  Current Online
   *
   * @Route("/current_online", name="current_online")
   */
  public function currentOnline() {
      $repo = $this->get('doctrine')->getManager('game')->getRepository('AppBundle:Character');
      $online_count = $repo->countOnlineCharacters();
      return  $this->json(array('online' => $online_count));
  }

}
