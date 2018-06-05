<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Lesson;
use AppBundle\Form\PersonType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


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
     * @Route("/member/profiel", name="memberProfiel")
     */
    public function profielAction(Request $request,  UserPasswordEncoderInterface $encoder)
    {
        $person = $this->get('security.token_storage')->getToken()->getUser();
        $form = $this->createForm(PersonType::class, $person);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $validator = $this->get('validator');
            $errors = $validator->validate($person);

            if (count($errors) > 0) {

                return $this->render('member/profiel.html.twig', [
                    "form" => $form->createView(),
                    "errors" => $errors
                ]);
            }

            $entityManager = $this->getDoctrine()->getManager();

            $password = $encoder->encodePassword($person, $person->getPlainPassword());
            $person->setPassword($password);

            $entityManager->persist($person);
            $entityManager->flush();

            return $this->redirectToRoute("memberHomepage");
        }

        return $this->render('/member/profiel.html.twig', [
            "form" => $form->createView()
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