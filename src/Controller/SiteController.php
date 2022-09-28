<?php

namespace App\Controller;
use App\Entity\Presentation;
use App\Controller\SecurityController;
use App\Controller\RegistrationController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    /**
     * @Route("/site", name="app_site")
     */
    public function index(): Response
    {
        $repo=$this->getDoctrine()->getRepository(Presentation::Class);
        $presentations=$repo->findAll();
        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
            'presentations'=>$presentations,
        ]);
    }
   
}
