<?php
/**
 * Created by PhpStorm.
 * User: or_os
 * Date: 20.11.2017
 * Time: 14:56
 */

namespace AppBundle\Controller\web\Admin;

use AppBundle\Entity\Organisations;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\OrganisationsType;


class OrganisationsController extends Controller
{

    /**
     * Organisations list page
     *
     * @Route("/admin/organisations", name="admin_organisations_list")
     * @Template()
     */
    public function indexAction(){

        $repo = $this->get('doctrine')->getRepository('AppBundle:Organisations');
        $organisations = $repo->findAll();

        return compact('organisations');
    }


    /**
     *
     * organisations edit
     * sl - for tralling slash if its needed
     *
     * @Route("admin/organisations/edit/{id}{sl}", name="admin_organisations_edit", defaults={"sl" : ""}, requirements={"id" : "[1-9][0-9]*","sl":"/?"})
     * @Template()
     */
    public function editAction(Request $request){

        $id = $request->get('id');
        $doctrine = $this->get('doctrine');
        $organisations = $doctrine->getRepository('AppBundle:Organisations')->find($id);

        if(!$organisations){
            throw $this -> createNotFoundException('Organisation not found');
        }

        $form = $this->createForm(OrganisationsType::class, $organisations);

        $form->handleRequest($request); // В форму загяняем данніе после сабмита, но еще не сохраняем

        if ($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($organisations);
            $em->flush();

            $this->addFlash('success', "Saved");
            return $this->redirectToRoute('admin_organisations_edit', ['id' => $id]);
        }

              return ['organisations' => $organisations, 'form' => $form->createView()];
    }


    /**
     *
     * organisations by id
     * sl - for tralling slash if its needed
     *
     * @Route("admin/organisations/{id}{sl}", name="admin_organisations_page", defaults={"sl" : ""}, requirements={"id" : "[1-9][0-9]*","sl":"/?"})
     * @Template()
     */
    public function showAction($id)
    {
        $repo = $this->get('doctrine')->getRepository('AppBundle:Organisations');
        $organisations = $repo->find($id);

        if (!$organisations) {
            throw $this->createNotFoundException('Organisation not found');
        }

        return compact('organisations');
    }



//        $article->setTitle('Symfony start')->setContent('Some text bla bla');
//
//        $em = $this->get('doctrine')->getManager();
//
//        $em->persist($article);
//        $em->flush();

}