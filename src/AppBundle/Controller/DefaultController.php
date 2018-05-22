<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Person;
use AppBundle\Form\PersonType;
use AppBundle\Repository\PersonRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/gedragsregels", name="gedragsregels")
     */
    public function gedragsregelsAction(){
        return $this->render('/default/gedragsregels.html.twig');
    }


    /**
     * @Route("/registreren", name="registreren")
     */
    public function registrerenAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $person = new Person();
        $person->setIsInstructor(false);
        $person->setIsMember(false);
        $form = $this->createForm(PersonType::class, $person);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $password = $encoder->encodePassword($person, $person->getPlainPassword());
            $person->setPassword($password);

            $entityManager->persist($person);
            $entityManager->flush();

            return $this->redirectToRoute("homepage");
        }

        return $this->render('default/lid_worden.html.twig', [
            "form" => $form->createView()
        ]);
    }
}
