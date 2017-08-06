<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 05/08/17
 * Time: 13:43
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{

    public function loginAction(Request $request)
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_admin_index');
        } elseif($this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('app_user_home');
        }

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('AppBundle:backend:login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    public function loginCheckAction()
    {
        if($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_admin_index');
        }elseif($this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('app_user_home');
        }elseif($this->isGranted('IS_AUTHENTICATED_ANONYMOUSLY')) {
            return $this->redirectToRoute('app_user_home');
        }
    }

}