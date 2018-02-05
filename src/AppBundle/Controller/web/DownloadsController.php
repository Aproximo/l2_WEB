<?php

namespace AppBundle\Controller\web;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DownloadsController extends Controller
{
    /**
     * article list page
     *
     * @Route("/downloads", name="downloads")
     * @Template()
     */
    public function indexAction(){


        return [];
    }


}
