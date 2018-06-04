<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Lesson;
use AppBundle\Entity\Person;
use AppBundle\Entity\Training;
use AppBundle\Form\LessonType;
use AppBundle\Form\TrainingsformType;
use AppBundle\Form\PersonType;
use AppBundle\Repository\PersonRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
     * @Route("/admin/trainingadd", name="trainingAdd")
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

        return $this->render('admin/training.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/training", name="adminTrainingen")
     */
    public function trainingenAction()
    {
        $repository = $this->getDoctrine()->getRepository(Training::class);
        $training = $repository->findAll();

        return $this->render("admin/trainingen.html.twig", [
            "training" => $training
        ]);
    }

    /**
     * @Route("/admin/wijzigtraining/wijzig/{trainingId}", name="trainingWijzig")
     */
    public function wijzigTrainingAction(Request $request, $trainingId){
        $repository = $this->getDoctrine()->getRepository(Training::class);
        $training =$repository->find($trainingId);

        $form = $this->createForm(TrainingsformType::class, $training);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($training);
            $em->flush();

            $this->addFlash('notice', 'Training is aangepast!');
            return $this->redirectToRoute('adminHome');
        }

        return $this->render('admin/wijzigTraining.html.twig', [
            "form" => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/leden/verwijder/{trainingId}", name="trainingVerwijder")
     */
    public function verwijderTrainingAction($trainingId)
    {
        $repository = $this->getDoctrine()->getRepository(Training::class);
        $training = $repository->find($trainingId);

        $this->getDoctrine()->getManager()->remove($training);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('notice', 'De training is verwijderd');

        return $this->render('admin/index.html.twig');
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

    /**
     * @Route("/admin/lessen", name="adminLessen")
     */
    public function lessenAction()
    {
        $repository = $this->getDoctrine()->getRepository(Lesson::class);
        $lessons = $repository->findUpcoming();

        return $this->render("admin/lessen.html.twig", [
            'lessons' => $lessons
        ]);
    }

    /**
     * @Route("/admin/lessen/toevoegen", name="adminLesToevoegen")
     */
    public function lesToevoegenAction(Request $request)
    {
        $lesson = new Lesson();
        $lesson->setDate(new \DateTime());
        $form = $this->createForm(LessonType::class, $lesson);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($lesson);
            $manager->flush();

            $this->addFlash('notice', 'Les is toegevoegd');
            return $this->redirectToRoute('adminLessen');
        }

        return $this->render('admin/les_toevoegen.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/lessen/wijzig/{lesId}", name="adminWijzigLes")
     */
    public function lesWijzigAction(Request $request, $lesId)
    {
        $repository = $this->getDoctrine()->getRepository(Lesson::class);
        $lesson = $repository->find($lesId);

        if(empty($lesson))
        {
            $this->addFlash('error', 'Deze les kon niet worden gevonden');
            return $this->redirectToRoute('adminHome');
        }

        $form = $this->createForm(LessonType::class, $lesson);
        $form->add('submit', SubmitType::class, ['label' => 'wijzigen']);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($lesson);
            $manager->flush();

            $this->addFlash('notice', 'Les is gewijzigd');
            return $this->redirectToRoute('adminLessen');
        }

        return $this->render('admin/les_toevoegen.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/lessen/{lesId}/deelnemers", name="adminLesDeelnemers")
     */
    public function lesDeelnemersAction(Request $request, $lesId)
    {
        $repository = $this->getDoctrine()->getRepository(Lesson::class);
        $lesson = $repository->find($lesId);

        if(empty($lesson))
        {
            $this->addFlash('error', 'Deze les kon niet worden gevonden');
            return $this->redirectToRoute('adminHome');
        }

        $registrations = $lesson->getRegistrations();
        return $this->render('admin/deelnemersLijst.html.twig', [
            'registrations' => $registrations
        ]);
    }
}