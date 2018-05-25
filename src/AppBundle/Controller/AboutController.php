<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AboutController extends Controller
{
    /**
     * About page
     *
     * @Route("/about", name="about")
     * @Template()
     */
    public function indexAction(Request $request) {
      $lang = $request->getLocale();
      $fileLocator = $this->get('file_locator');
      $path = $fileLocator->locate("@AppBundle/Resources/custom/about.$lang.txt");
      return ['content' => file_get_contents($path)];
    }

}
