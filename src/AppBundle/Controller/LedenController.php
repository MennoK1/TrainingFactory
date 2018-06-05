<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Lesson;
use AppBundle\Entity\Person;
use AppBundle\Entity\Registration;
use Doctrine\Common\Collections\ArrayCollection;
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
        /** @var Person $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $repository = $this->getDoctrine()->getRepository(Lesson::class);
        $lessons = $repository->findUpcoming();

        return $this->render("member/aanbod.html.twig", [
            "lessons" => $lessons
        ]);
    }

    /**
     * @Route("/member/aanbod/{lesId}/inschrijven", name="memberInschrijven")
     */
    public function lesInschrijvenAction($lesId)
    {
        $repository = $this->getDoctrine()->getRepository(Lesson::class);
        $les = $repository->find($lesId);
        if(empty($les) || $les->getDate() < new \DateTime())
        {
            $this->addFlash('error', 'Deze les kon niet worden gevonden');
            return $this->redirectToRoute("memberAanbod");
        }

        if(count($les->getRegistrations()) >= $les->getMaxPersons())
        {
            $this->addFlash('error', 'Deze les is vol');
            return $this->redirectToRoute("memberAanbod");
        }

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $registration = new Registration();
        $registration->setLesson($les);
        $registration->setPerson($user);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($registration);
        $manager->flush();

        $this->addFlash('notice', 'U bent voor deze les insgeschreven');
        return $this->redirectToRoute('memberAanbod');
    }

    /**
     * @Route("/member/aanbod/{lesId}/uitschrijven", name="memberUitschrijven")
     */
    public function lesUitschrijvenAction($lesId)
    {
        $repository = $this->getDoctrine()->getRepository(Lesson::class);
        $les = $repository->find($lesId);

        if(empty($les))
        {
            $this->addFlash('error', 'Deze les kon niet worden gevonden');
            return $this->redirectToRoute("memberAanbod");
        }

        /** @var Person $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if(!$les->isIngeschreven($user))
        {
            $this->addFlash('error', 'U bent niet voor deze les ingeschreven');
            return $this->redirectToRoute("memberAanbod");
        }

        $repository = $this->getDoctrine()->getRepository(Registration::class);
        $registration = $repository->findSpecific($user->getId(), $les->getId());

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($registration);
        $manager->flush();

        $this->addFlash('error', 'U bent succesvol uitgeschreven');
        return $this->redirectToRoute("memberAanbod");
    }
}