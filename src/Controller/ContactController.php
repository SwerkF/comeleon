<?php

namespace App\Controller;
use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function index( Request $request): Response
    {
        $contact= new Contact();
        $repo = $this->getDoctrine()->getRepository(Contact::class);
        $contact=$repo->findAll();
    
        $contact2 = new Contact();
        $form = $this->createFormBuilder($contact2)
        ->add('nom',TextType::class)
        ->add('prenom',TextType::class)
        ->add('email',TextType::class)
        ->add('telephone',IntegerType::class)
        ->add('adresse',TextType::class)
        ->add('sujet',TextType::class)
        ->add("message",TextType::class)
        ->add('save', SubmitType::class, array('label'=>'Envoyer',
        'attr'=>array('class'=>'btn')
           
        ))
        ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $avis = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact2);
            $entityManager->flush();

            $contact3 = new Contact();
            $repo = $this->getDoctrine()->getRepository(Contact::class);
            $contact3=$repo->findAll();
            return $this->render('contact/index.html.twig', [
                'controller_name' => 'ContactController',
                'contact2' => $contact3,
                'form'=>$form->createView()
            ]);
        
           
        }
        
       
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'contact2'=>$contact,
            'form'=>$form->createView()
        ]);
    }
    
}
