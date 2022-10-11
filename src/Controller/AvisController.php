<?php

namespace App\Controller;
use App\Entity\Avis;
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
    public function index(Request $request): Response
    {
        $avis = new Avis();
        $repo = $this->getDoctrine()->getRepository(Avis::class);
        $avis=$repo->findAll();
    
        $avis2 = new Avis();
        $form = $this->createFormBuilder($avis2)
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
            $entityManager->persist($avis2);
            $entityManager->flush();

            $avis3 = new Avis();
        $repo = $this->getDoctrine()->getRepository(Avis::class);
        $avis3=$repo->findAll();
           
            return $this->render('avis/index.html.twig', [
                'controller_name' => 'AvisController',
                'avis2' => $avis3,
                'form'=>$form->createView()
            ]);

           
        }
        return $this->render('avis/index.html.twig', [
            'controller_name' => 'AvisController',
            'avis2' => $avis,
            'form'=>$form->createView()
        ]);
    }  
    /**
     * @Route("/avis/delete/{id}")
     * Method({"DELETE"})
     */
    public function delete(Request $request,$id) {
        $avis = $this->getDoctrine()->getRepository(Avis::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($avis);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }  
    
   

}