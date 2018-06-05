<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Lesson;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Security("has_role('ROLE_MEMBER')")
 */
class LedenController extends Controller
{
    /**
     * @Route("/member", name="memberHomepage")
     */
    public function indexAction(Request $request)
    {

        return $this->render('member/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * @Route("/member/gedragsregels", name="memberGedragsregels")
     */
    public function gedragsregelsAction()
    {
        return $this->render('/member/gedragsregels.html.twig');
    }

    /**
     * @Route("/member/contact", name="memberContact")
     */
    public function contactAction()
    {
        return $this->render('/member/contact.html.twig');
    }

    /**
     * @Route("/member/aanbod", name="memberAanbod")
     */
    public function lesAanbodAction()
    {
        $repository = $this->getDoctrine()->getRepository(Lesson::class);
        $lessons = $repository->findUpcoming();
        return $this->render("member/aanbod.html.twig", [
            "lessons" => $lessons
        ]);
    }
}