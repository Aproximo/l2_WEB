<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DownloadsController extends Controller
{
    /**
     *
     * @Route("/downloads", name="downloads")
     * @Template()
     */
    public function indexAction() {
        return [];
    }


}
