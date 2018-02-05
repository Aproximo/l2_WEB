<?php

namespace AppBundle\Controller\web\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;


class DefaultController extends Controller
{
    /**
     * @Route("/admin", name="admin_default")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        return [];

    }

}