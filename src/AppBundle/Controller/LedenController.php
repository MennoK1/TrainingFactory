<?php
/**
 * Created by PhpStorm.
 * User: Tepelstreeltje
 * Date: 4-6-2018
 * Time: 11:53
 */

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
     * @Route("/member", name="homepage")
     */
    public function indexAction(Request $request)
    {

        return $this->render('member/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * @Route("/member/gedragsregels", name="gedragsregels")
     */
    public function gedragsregelsAction()
    {
        return $this->render('/member/gedragsregels.html.twig');
    }

    /**
     * @Route("/member/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render('/member/contact.html.twig');
    }

    /**
     * @Route("/member/aanbod", name="aanbod")
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