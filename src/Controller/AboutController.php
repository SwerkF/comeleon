<?php

 

namespace App\Controller;

 

use App\Entity\Presentation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;


 

class AboutController extends AbstractController
{
    /**
     * @Route("/about", name="app_about")
     */
    public function index(): Response
    {
        $presentation = $this->getDoctrine()->getRepository(Presentation::class)->findAll();
        return $this->render('presentation/index.html.twig', [
            'controller_name' => '',
            'presentation' => $presentation,
        ]);
    }

    //===========================================EDIT=======================================================
    /**
     * @Route("/about/editP", name="app_about_editP")
     */
    public function editPresentation(Request $request): Response
    {


        $presentationP = new Presentation();
        $presentationP = $this->getDoctrine()->getRepository(Presentation::class)->find(1);
        
        $editPresentation = $this->getDoctrine()->getRepository(Presentation::class)->findAll();

        $formP = $this->createFormBuilder($presentationP)
        ->add("titre", TextType::class)
        ->add('description', TextType::class)
        ->add('save', SubmitType::class, array(
            'label' => 'Appliquer',
            'attr' => array('class' => 'btn btn-success btn-block'),
        ))
        ->getForm();
        $formP->handleRequest($request);
        if ($formP->isSubmitted() && $formP->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('app_menu');

        }

        return $this->render('presentation/editPresentation.html.twig', [
            'controller_name' => '',
            'presentation' => $editPresentation,
            'formP' => $formP->createView(),
        ]);

    }

    /**
     * @Route("/about/editE", name="app_about_editE")
     */
    public function editEtude(Request $request): Response
    {
        $editEtude = $this->getDoctrine()->getRepository(Presentation::class)->findAll();
        $presentationE = new Presentation();
        $presentationE = $this->getDoctrine()->getRepository(Presentation::class)->find(2);

        $formE = $this->createFormBuilder($presentationE)
        ->add("titre", TextType::class)
        ->add('description', TextType::class)
        ->add('save', SubmitType::class, array(
            'label' => 'Appliquer',
            'attr' => array('class' => 'btn btn-success btn-block'),
        ))
        ->getForm();
        $formE->handleRequest($request);
        if ($formE->isSubmitted() && $formE->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('app_menu');

        }
        return $this->render('presentation/editEtude.html.twig', [
            'controller_name' => '',
            'presentation' => $editEtude,
            'formE' => $formE->createView(),
        ]);
    }
}