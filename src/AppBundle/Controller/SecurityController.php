<?php
/**
 * Created by PhpStorm.
 * User: Pride White
 * Date: 10/10/2018
 * Time: 1:03 PM
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{

    public function loginAction(AuthenticationUtils $authenticationUtils) {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('AppBundle:Default:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
}