<?php
/**
 * Created by PhpStorm.
 * User: Tepelstreeltje
 * Date: 22-5-2018
 * Time: 12:16
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request,AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('default/login.html.twig',[
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
}