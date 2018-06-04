<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Person;
use AppBundle\Entity\Training;
use AppBundle\Form\TrainingsformType;
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
     * @Route("/admin/training", name="trainingAdd")
     */
    public function trainingAction(Request $request)
    {
        $training = new Training();
        $form = $this->createForm(TrainingsformType::class, $training);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $training = $form->getData();
            $em = $this->getDoctrine()->getManager();

            $em->persist($training);

            $em->flush();
            $this->addFlash('success', 'Training toegevoegd!');
            return $this->redirectToRoute('adminHome');
        }

        return $this->render("", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/leden/wijzig/{lidId}", name="adminWijzigLid")
     */
    public function wijzigLidAction(Request $request, $lidId)
    {
        $repository = $this->getDoctrine()->getRepository(Person::class);
        $person = $repository->find($lidId);

        if(empty($person) || !$person->getIsMember())
        {
            $this->addFlash('error', 'Deze persoon kon niet worden gevonden');
            return $this->redirectToRoute('adminHome');
        }

        $form = $this->createForm(PersonType::class, $person);
        $form->remove('plainPassword');
        $form->remove('loginname');

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

            $this->addFlash('notice', 'De persoon is aangepast');
            return $this->redirectToRoute('adminLeden');
        }

        return $this->render('admin/wijzigLid.html.twig', [
            "form" => $form->createView()
        ]);
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
     * @Route("/admin/leden/verwijder/{lidId}", name="adminVerwijderLid")
     */
    public function verwijderLidAction($lidId)
    {
        $repository = $this->getDoctrine()->getRepository(Person::class);
        $person = $repository->find($lidId);

        if(empty($person) || !$person->getIsMember())
        {
            $this->addFlash('error', 'Deze persoon kon niet worden gevonden');
            return $this->redirectToRoute('adminHome');
        }

        $this->getDoctrine()->getManager()->remove($person);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('notice', 'De persoon is verwijderd');

        return $this->render('admin/leden.html.twig');
    }
}