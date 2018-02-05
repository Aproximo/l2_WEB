<?php
/**
 * Created by PhpStorm.
 * User: or_os
 * Date: 20.12.2017
 * Time: 12:29
 */

namespace AppBundle\Controller\Api;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;


class ProgrammerController extends Controller
{
    /**
     * @Route("/api/users", name="api")
     */
    public function indexAction()
    {   header("Access-Control-Allow-Origin: *");
        // dz: get 500, 404 json if errors
        $users = $this
            ->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findAll()
        ;

        if (!$users) {
            throw $this->createNotFoundException('D\'oh! Book not found');
        }

        $array = $this->get('jms_serializer')->serialize($users, 'json');


        return new JsonResponse($array);
    }

}