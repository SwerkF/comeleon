<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Prestations;

class MenuController extends AbstractController
{
    
    #[Route('/menu', name: 'app_menu')]
    public function index() {
        return $this->render('menu/index.html.twig');
    }


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
    /**
     * @Route("/menu/prestations/add", name="app_prestation_ajt")
     * Method({"GET", "POST"})
     */
    public function addPresta(Request $request) {
        
        $prestations = new Prestations();

        $form = $this->createFormBuilder($prestations)
        ->add("libelle", TextType::class)
        ->add("description", TextType::class)
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

    /**
     * @Route("/menu/prestations/edit/{id}", name="app_prestation_edit")
     * Method({"GET", "POST"})
     */
    public function editPresta(Request $request, $id) {
        
        $prestations = new Prestations();
        $prestations = $this->getDoctrine()->getRepository(Prestations::class)->find($id);

        $form = $this->createFormBuilder($prestations)
        ->add("libelle", TextType::class)
        ->add("description", TextType::class)
        ->add('save', SubmitType::class, array(
            'label' => 'Appliquer',
            'attr' => array('class' => 'btn btn-success btn-block'),
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
}
