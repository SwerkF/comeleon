<?php

namespace App\Controller;
use App\Entity\Mentions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MentionsController extends AbstractController
{
    #[Route('/mentions', name: 'app_mentions')]
    public function index(Request $request): Response
    {

        $mentions = $this->getDoctrine()->getRepository(Mentions::class)->findAll();

        return $this->render('mentions/index.html.twig', [
            'controller_name' => 'MentionsController',
            'mentions'=>$mentions
        ]);
    }

     /**
     * @Route("/mentions/edit", name="app_mentions_edit")
     * Method({"GET", "POST"})
     */
    public function editmentions(Request $request): Response
    {
        $mentions = new Mentions();
        $mentions = $this->getDoctrine()->getRepository(Mentions::class)->find(1);

        $form = $this->createFormBuilder($mentions)
        ->add("nom", TextType::class)
        ->add("adresse", TextType::class)
        ->add("proprio", TextType::class)
        ->add("responsable", TextType::class)
        ->add("conception", TextType::class)
        ->add("animation", TextType::class)
        ->add("hebergement", TextType::class)
        ->add('save', SubmitType::class, array(
            'label' => 'Appliquer',
            'attr' => array('class' => 'btn btn-success btn-block'),
        ))
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('app_mentions');

        } else {
            return $this->render('mentions/edit.html.twig', [
                'controller_name' => 'MentionsController',
                'form' => $form->createView()

            ]);
        }


       
    }
}
