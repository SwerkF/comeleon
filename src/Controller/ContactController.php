<?php

namespace App\Controller;
use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function index(): Response
    {
        $contact = $this->getDoctrine()->getRepository(Contact::class)->findAll();
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'contact'=>$contact
        ]);
    }
    public function addContact(Request $request) {
        
        $contact = new Contact();

        $formContact= $this->createFormBuilder($contact)

        ->add("commentaire",TextType::class)
        ->add('save', SubmitType::class, array('label'=>'Ajouter',
        'attr'=>array('class'=>'btn')
           
        ))
        ->getForm();
        $formContact->handleRequest($request);
        if ($formContact->isSubmitted() && $formContact->isValid()) {
            $avis = $formContact->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($avis);
            $entityManager->flush();
            return $this->redirect('app_avis');

           
        }
}
}