<?php

 

namespace App\Controller;

 

use App\Entity\Presentation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

 

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
}