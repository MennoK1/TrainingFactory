<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Person;
use AppBundle\Entity\Training;
use AppBundle\Form\TrainingsformType;
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
    public function trainingAction(Request $request){
        $training = new Training();
        $form = $this->createForm(TrainingsformType::class, $training);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $training = $form->getData();
            $em = $this->getDoctrine()->getManager();

            $em->persist($training);

            $em->flush();
            $this->addFlash('success', 'Training toegevoegd!');
            return $this->redirectToRoute('homepage');
        }

        return $this->render("", [
            "form" => $form->createView()
        ]);
    }
}