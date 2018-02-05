<?php

namespace AppBundle\Controller\web\User;

use AppBundle\AppBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route("/user", name="user_default")
     * @Template()
     */
    public function indexAction(Request $request)
    {
    $user = $this->get('security.token_storage')->getToken()->getUser();

    $organisation = $this->get('security.token_storage')->getToken()->getUser()->getOrganisation();
    $role = json_encode($user->getRoles());

        if ( strpos($role, "ROLE_ADMIN") ){
            dump('here');
            return $this->redirectToRoute('admin_default');
        }else {
            return ['user' => $user, 'organisation' => $organisation];
        }
    }



}


//       $ch = curl_init();
//       curl_setopt($ch, CURLOPT_URL, 'www.someapi.com?param1=A&param2=B');
//       curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')); // Assuming you're requesting JSON
//       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//
//       $response = curl_exec($ch);
//
//// If using JSON...
//       $data = json_decode($response);
