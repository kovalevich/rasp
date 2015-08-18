<?php

namespace Blog\PublicationsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $publication = $em->getRepository('BlogPublicationsBundle:Publication')->findOneBySlug($slug);

        return $this->render('BlogPublicationsBundle:Default:index.html.twig', array('publication' => $publication));
    }

    public function categoryAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('BlogPublicationsBundle:Category')->findOneBySlug($slug);

        if (!$category) {
            throw $this->createNotFoundException('Извините, вы не туда попали. Но вы можете посетить <a href="http://autorinok.by">онлайн авторынок Беларуси</a>');
        }

        $page = $request->get('page');
        if(!is_numeric($page) || $page < 1) $page = 1;

        $query = $em->getRepository('BlogPublicationsBundle:Publication')->getPage($category->getId());

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $page,
            10
        );

        return $this->render('BlogPublicationsBundle:Default:category.html.twig', array(
            'pagination'  => $pagination,
            'category'      => $category
        ));
    }
}
