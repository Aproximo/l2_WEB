<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;

class ArticleController extends Controller
{
    /**
     * article list page
     *
     * @Route("/news", name="news")
     * @Template()
     */
     public function indexAction(Request $request) {
         $repo = $this->get('doctrine')->getRepository('AppBundle:Article');
         $articles = $repo->findAllByLocale($request->getLocale());
         return compact('articles');
     }

}
