<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_INSTRUCTOR')")
 */
class AdminController extends Controller
{
    /**
     * @Route("/admin", name="adminHome")
     */
    public function indexAction()
    {
        return $this->render("admin/index.html.twig");
    }
}