<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Person;
use AppBundle\Form\PersonType;
use AppBundle\Repository\PersonRepository;
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

    /**
     * @Route("/admin/leden", name="adminLeden")
     */
    public function ledenAction()
    {
        $repository = $this->getDoctrine()->getRepository(Person::class);
        $members = $repository->findMembers();

        return $this->render("admin/leden.html.twig", [
            "members" => $members
        ]);
    }

    /**
     * @Route("/admin/leden/wijzig/{lidId}", name="adminWijzigLid")
     */
    public function wijzigLidAction(Request $request, $lidId)
    {
        $repository = $this->getDoctrine()->getRepository(Person::class);
        $person = $repository->find($lidId);

        if(empty($person))
        {
            $this->addFlash('error', 'Deze persoon kon niet worden gevonden');
            return $this->redirectToRoute('adminHome');
        }

        $form = $this->createForm(PersonType::class, $person);
        $form->remove('plainPassword');
        $form->remove('loginname');

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

            $this->addFlash('notice', 'De persoon is aangepast');
            return $this->redirectToRoute('adminHome');
        }

        return $this->render('admin/wijzigLid.html.twig', [
            "form" => $form->createView()
        ]);
    }
}