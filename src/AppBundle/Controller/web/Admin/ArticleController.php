<?php
/**
 * Created by PhpStorm.
 * User: or_os
 * Date: 20.11.2017
 * Time: 14:56
 */

namespace AppBundle\Controller\web\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\ArticleType;


class ArticleController extends Controller
{

    /**
     * article list page
     *
     * @Route("/admin/article", name="admin_article_list")
     * @Template()
     */
    public function indexAction(){

        $repo = $this->get('doctrine')->getRepository('AppBundle:Article');
        $articles = $repo->findAll();

        return compact('articles');
    }


    /**
     *
     * article edit
     * sl - for tralling slash if its needed
     *
     * @Route("admin/article/edit/{id}{sl}", name="admin_article_edit", defaults={"sl" : ""}, requirements={"id" : "[1-9][0-9]*","sl":"/?"})
     * @Template()
     */
    public function editAction(Request $request){

        $id = $request->get('id');
        $doctrine = $this->get('doctrine');
        $article = $doctrine->getRepository('AppBundle:Article')->find($id);

        if(!$article){
            throw $this -> createNotFoundException('Article not found');
        }

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request); // В форму загяняем данные после сабмита, но еще не сохраняем

        if ($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($article);
            $em->flush();

            $this->addFlash('success', "Saved");
            return $this->redirectToRoute('article_edit', ['id' => $id]);
        }

              return ['article' => $article, 'form' => $form->createView()];
    }

//        $article->setTitle('Symfony start')->setContent('Some text bla bla');
//
//        $em = $this->get('doctrine')->getManager();
//
//        $em->persist($article);
//        $em->flush();

}