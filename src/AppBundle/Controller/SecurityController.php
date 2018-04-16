<?php
/**
 * Created by PhpStorm.
 * User: or_os
 * Date: 21.11.2017
 * Time: 17:26
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use AppBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ChangePasswordType;
use AppBundle\Form\ForgotPasswordType;




class SecurityController extends Controller
{

    /**
     * @Route("/login", name="user_login")
     * @Template()
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {

        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();
dump($request);
        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();


        return ['last_username' => $lastUsername, 'error' => $error];
    }

    /**
     * @Route("/registration", name="user_registration")
     * @Template()
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('homepage');
        }

        return ['form' => $form->createView()];

    }


    /**
     * @Route("/user/changepassword", name="change_password")
     * @Template()
     */
    public function changePwAction (Request $request, UserPasswordEncoderInterface $passwordEncoder) {

        $user = $this->getUser();

        $form = $this->createForm(ChangePasswordType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('homepage');
        }


        return ['form' => $form->createView()];
    }

    /**
     * @Route("/forgotpassword", name="forgot_password")
     * @Template()
     */
    public function forgotPwAction (Request $request, \Swift_Mailer $mailer) {


        if($_SERVER['REQUEST_METHOD'] == 'POST') {


            $repo = $this->get('doctrine')->getManager('login')->getRepository('AppBundle:User');
            $user = $repo->findByLogin($_POST["_username"]);

            if(!$user){
                throw $this -> createNotFoundException('User not found');
            }

            //-------------
            $name = "Aproximo";
            $message = (new \Swift_Message('Hello Email'))
                ->setFrom('Romanyk94@gmail.com')
                ->setTo('romaniuk.o@organicstandard.com.ua')
                ->setBody(
                    $this->renderView(
                    // app/Resources/views/Emails/registration.html.twig
                        'Emails/registration.html.twig',
                        array('name' => $name)
                    ),
                    'text/html'
                )

                /*
                 * If you also want to include a plaintext version of the message
                ->addPart(
                    $this->renderView(
                        'emails/registration.txt.twig',
                        array('name' => $name)
                    ),
                    'text/plain'
                )
                */
            ;

            if (!$mailer->send($message)){
                dump($mailer);
            die();
            }

            //-------
            dump($mailer);
//            die();
            return [];


        }


        return [];
    }


    /**
     * @Route("/logout", name="security_logout")
     * @Template()
     */
    public function logoutAction()
    {
        return [];
    }


}