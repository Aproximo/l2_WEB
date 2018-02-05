<?php

namespace AppBundle\Controller\web;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AboutController extends Controller
{
    /**
     * about page
     *
     * @Route("/about", name="about")
     * @Template()
     */
    public function indexAction(){


        return [];
    }




}
