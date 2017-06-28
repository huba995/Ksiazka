<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 10.06.17
 * Time: 16:28
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // pobranie błędu logowania, jeśli sie taki pojawił
        $error = $authenticationUtils->getLastAuthenticationError();
       // $error=$authUtils->getLastAuthenticationError();
        // nazwa użytkownika ostatnio wprowadzona przez aktualnego użytkownika
        $lastUsername = $authenticationUtils->getLastUsername();
        //$lastUsername=$authUtils->getLastUsername();

        return $this->render(
            'security/login.html.twig',
            array(
                // nazwa użytkownika ostatnio wprowadzona przez aktualnego użytkownika
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
   /*     $em=$this->getDoctrine()->getManager();
        $recipes=$em->getRepository('AppBundle:Recipes')->findmydisplay();
        if (!$recipes) {
            throw $this->createNotFoundException(
                'No product found for id '
            );
        }
        return $this->render('recipes/show1.html.twig', array('recipes'=>$recipes));*/
    }
}