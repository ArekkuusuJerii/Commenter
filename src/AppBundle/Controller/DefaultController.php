<?php

namespace AppBundle\Controller;

use BackendBundle\Entity\User;
use BackendBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('AppBundle:Default:index.html.twig', array());
    }

    public function usersAction(Request $request)
    {
        $manager = $this->getManager();
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $encoder_factory = $this->get('security.encoder_factory');
            $encoder = $encoder_factory->getEncoder($user);
            $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
            $user->setRegistrationDate(new \DateTime());
            $user->setPassword($password);
            $manager->persist($user);
            $manager->flush();
        }
        $list = $manager->getRepository('BackendBundle:User')->findAll();
        return $this->render('AppBundle:Default:user.html.twig', array(
            "list" => $list,
            "form" => $form->createView()
        ));
    }

    public function editAction($id, Request $request)
    {
        $manager = $this->getManager();
        $user_repository = $manager->getRepository('BackendBundle:User');
        $user = $user_repository->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();
        }
        $list = $user_repository->findAll();
        return $this->render('AppBundle:Default:user.html.twig', array(
            "list" => $list,
            "form" => $form->createView()
        ));
    }

    public function deleteAction($id)
    {
        $manager = $this->getManager();
        $user = $manager->getRepository('BackendBundle:User')->find($id);
        $manager->remove($user);
        $manager->flush();
        return $this->redirectTo('app_users');
    }

    public function commentsAction()
    {
        return $this->render('AppBundle:default:comment.html.twig', array());
    }

    private function getManager()
    {
        return $this->getDoctrine()->getManager();
    }

    private function redirectTo($route)
    {
        return $this->redirect($this->generateUrl($route));
    }
}
