<?php

namespace App\Controller;
use App\Entity\Avis;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AvisController extends AbstractController
{
    /**
     * @Route("/avis", name="app_avis")
     */
    public function index(): Response
    {

        $repo = $this->getDoctrine()->getRepository(Avis::class);
    $avis=$repo->findAll();
    $avis = new Avis();

        $form = $this->createFormBuilder($avis)
        ->add('nom',TextType::class)
        ->add('prenom',TextType::class)
        ->add("commentaire",TextType::class)
        ->add('save', SubmitType::class, array('label'=>'Enregistrer',
        'attr'=>array('class'=>'btn')
           
        ))
        ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $avis = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($avis);
            $entityManager->flush();
            return $this->redirect('app_avis');

           
        }
        return $this->render('avis/index.html.twig', [
            'controller_name' => 'AvisController',
            'avis' => $avis,
            'form'=>$form
        ]);
    }
    /**
     * @Route("/create_avis", name="app_avis_create")
     */
    
   

}