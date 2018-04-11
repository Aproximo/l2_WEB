<?php
/**
 * Created by PhpStorm.
 * User: or_os
 * Date: 28.11.2017
 * Time: 10:39
 */

namespace AppBundle\Controller\Web\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class UserController extends Controller
{
    /**
     * users list
     *
     * @Route("/admin/users", name="admin_users_list")
     * @Template()
     */
    public function indexAction(){

        $repo = $this->get('doctrine')->getRepository('AppBundle:User');
        $users = $repo->getRoles("ROLE_USER");
        dump($users);

        return compact('users');
    }



    /**
     *  add new user
     *
     * @Route("/admin/users/add", name="admin_users_add")
     * @Template()
     */
    public function addAction(Request $request)
    {   // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $encoder = $this->container->get('security.password_encoder');
            $passwordEncoded = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($passwordEncoded);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('admin_users_list');
        }
        return       ['form' => $form->createView()];
    }


    /**
     *  edit new user
     *
     *  sl - for tralling slash if its needed
     *
     * @Route("/admin/users/edit/{id}{sl}", name="admin_user_edit", defaults={"sl" : ""}, requirements={"id" : "[1-9][0-9]*","sl":"/?"})
     * @Template()
     */
    public function editAction(Request $request){

        $id = $request->get('id');
        $doctrine = $this->getDoctrine();
        $user = $doctrine->getRepository('AppBundle:User')->find($id);

        if(!$user){
            throw $this -> createNotFoundException('User not found');
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request); // В форму загяняем данніе после сабмита, но еще не сохраняем

        if ($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', "Saved");
            return $this->redirectToRoute('admin_editUser', ['id' => $id]);
        }

        return ['user' => $user, 'form' => $form->createView()];
    }

}
