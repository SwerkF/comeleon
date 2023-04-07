<?php

namespace App\Controller;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Prestations;
use App\Entity\User;

class MenuController extends AbstractController
{
    
    #[Route('/menu/index', name: 'app_menu')]
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasher) {
        $user = new User();
        $user = $this->getDoctrine()->getRepository(User::class)->find($this->getUser()->getId());

        $form = $this->createFormBuilder($user)
        ->add("nom", TextType::class)
        ->add("prenom", TextType::class)
        ->add("email", TextType::class)
        ->add("password", PasswordType::class)
        ->add('save', SubmitType::class, array(
            'label' => 'Sauvegarder',
            'attr' => array('class' => 'btn btn-success btn-block'),
        ))
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('app_logout');

        }

        return $this->render('menu/index.html.twig', array('form' => $form->createView()));
    }

    //
    //MENU
    //=========================================================================================================================================================
    //PRESTATIONS
    //

    //===========================================AFFICHAGE=======================================================
    /**
     * @Route("/menu/prestations/index", name="app_prestation_show")
     */
    public function prestationIndex() {
        $prestations = $this->getDoctrine()->getRepository(Prestations::class)->findAll();
        return $this->render('menu/prestations/index.html.twig', [
            'controller_name' => 'MenuController',
            'prestations' => $prestations,
        ]);
    }
    
    //===========================================AJOUT=======================================================
    /**
     * @Route("/menu/prestations/add", name="app_prestation_ajt")
     * Method({"GET", "POST"})
     */
    public function addPresta(Request $request) {
        
        $prestations = new Prestations();

        $form = $this->createFormBuilder($prestations)
        ->add("libelle", TextType::class)
        ->add('image', ChoiceType::class, [
            'choices'  => [
                'Cable aerien' => "fibre_aerien.png",
                'Cable souterrain' => "fibre_soute.jpg",
                'Prise rond' => "prise_telephone.png",
                'Prise electrique' => "prise.png",
            ],
        ])
        ->add('prix', TextType::class)
        ->add('save', SubmitType::class, array(
            'label' => 'Ajouter',
            'attr' => array('class' => 'btn btn-success btn-block'),
        ))
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $prestations = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prestations);
            $entityManager->flush();

            return $this->redirectToRoute('app_prestation_show');

        }
        return $this->render('menu/prestations/add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    //===========================================EDIT=======================================================
    /**
     * @Route("/menu/prestations/edit/{id}", name="app_prestation_edit")
     * Method({"GET", "POST"})
     */
    public function editPresta(Request $request, $id) {
        
        $prestations = new Prestations();
        $prestations = $this->getDoctrine()->getRepository(Prestations::class)->find($id);

        $form = $this->createFormBuilder($prestations)
        ->add("libelle", TextType::class)
        ->add('image', ChoiceType::class, [
            'choices'  => [
                'Cable aerien' => "fibre_aerien.png",
                'Cable souterrain' => "fibre_soute.jpg",
                'Prise rond' => "prise_telephone.png",
                'Prise electrique' => "prise.png",
            ],
        ])
        ->add('prix', TextType::class)
        ->add('save', SubmitType::class, array('label'=>'Enregistrer',
        'attr'=>array('class'=>'btn')
           
        ))
        ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('app_prestation_show');

        }
        return $this->render('menu/prestations/edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    //===========================================DELETE=======================================================
    /**
     * @Route("/menu/prestation/delete/{id}")
     * Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $prestations = $this->getDoctrine()->getRepository(Prestations::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($prestations);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    } 
    //
    //PRESTATIONS
    //=========================================================================================================================================================
    //PRESENTATION
    //
}
