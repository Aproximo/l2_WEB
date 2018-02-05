<?php
/**
 * Created by PhpStorm.
 * User: or_os
 * Date: 20.11.2017
 * Time: 14:56
 */

namespace AppBundle\Controller\web\User;

use AppBundle\Entity\Organisations;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\OrganisationsType;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;




class OrganisationsController extends Controller
{


    /**
     * Organisations list page
     *
     * @Route("/user/organisation", name="user_organisation")
     * @Template()
     */
    public function indexAction(){

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $organisation = $this->get('security.token_storage')->getToken()->getUser()->getOrganisation();

        return['user' => $user, 'organisation' => $organisation];


    }


    /**
     * Organisations list page
     *
     * @Route("/user/organisation/mail", name="user_organisation_mail")
     * @Template()
     */
    public function sendMailAction(\Swift_Mailer $mailer){
        $name = "Hello World";
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('send@example.com')
            ->setTo('or@organicstandard.com.ua')
            ->setBody(
                $this->renderView(
                // templates/emails/registration.html.twig
                    'emails/registration.html.twig',
                    array ('name' => $name)
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

        $numSent = $mailer->send($message);
        dump($numSent);


        return $this->render('emails/registration.html.twig', array ('name' => $name));
    }

    /**
     *
     * organisations edit
     * sl - for tralling slash if its needed
     *
     * @Route("user/organisations/edit{sl}", name="user_organisations_edit", defaults={"sl" : ""}, requirements={"sl":"/?"})
     * @Template()
     */
    public function editAction(Request $request){
    dump("here");
        $doctrine = $this->get('doctrine');

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $organisation = $this->get('security.token_storage')->getToken()->getUser()->getOrganisation();

        $form = $this->createForm(OrganisationsType::class, $organisation);

        $form->handleRequest($request); // В форму загяняем данніе после сабмита, но еще не сохраняем

        if ($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($organisation);
            $em->flush();

            $this->addFlash('success', "Saved");
            return $this->redirectToRoute('user_organisations_edit');
        }

              return ['organisations' => $organisation, 'form' => $form->createView()];
    }



    /**
     * @Route("user/api/organisations/{id}{sl}", name="user_api_organisations_page", defaults={"sl" : ""}, requirements={"id" : "[1-9][0-9]*","sl":"/?"})
     * @View()
     * @ParamConverter("data", class="AppBundle:Organisations")
     */
//    public function getBookApiAction($id)
//    {
//        // dz: get 500, 404 json if errors
//
//        $doctrine = $this->get('doctrine');
//        $book = $doctrine->getRepository('AppBundle:Organisations')->find($id);
//
//        if (!$book) {
//            throw $this->createNotFoundException('D\'oh! Book not found');
//        }
//
//
//
////        dump(gettype($book));
//        $serializer = $this->container->get('jms_serializer');
//        $data = $serializer->serialize($book, "json");
//        $data = preg_replace("/\"_user_i_d(.*)},/", '', $data);
//
//
//
//        return new Response($data);
//    }


//        $article->setTitle('Symfony start')->setContent('Some text bla bla');
//
//        $em = $this->get('doctrine')->getManager();
//
//        $em->persist($article);
//        $em->flush();

}