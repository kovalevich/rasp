<?php

namespace Profile\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Model\UserInterface;

/**
 * Controller set
 *
 */
class SetController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $form = $this->createFormBuilder($user)
            ->add('card', 'text', array(
                'label' => 'Номер Вашей банковской карты и срок действия. Пример: 9112 0002 5165 7867 до 10/16',
            ))
            ->add('bank', 'choice', array(
                'label' => 'Ваш банк',
                'choices' => array('БПС-Сбербанк'=>'БПС-Сбербанк', 'Беларусбанк'=>'Беларусбанк')
            ))
            ->add('save', 'submit', array(
                'label' => 'Сохранить',
                'attr' => array('class'=>'btn-success')
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $form->getData();
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('fos_user_profile_show'));
        }

        return $this->render('ProfileUserBundle:Profile:set.html.twig', array(
            'form'  => $form->createView()
        ));
    }
}


