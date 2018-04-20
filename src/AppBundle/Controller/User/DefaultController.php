<?php

namespace AppBundle\Controller\User;

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
            return $this->redirectToRoute('admin_default');
        }else {
            return ['user' => $user, 'organisation' => $organisation];
        }
    }
}
