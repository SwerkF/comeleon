<?php

namespace App\Controller;

use App\Entity\Prestations;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrestationController extends AbstractController
{
    /**
     * @Route("/prestation", name="app_prestation")
     */
    public function index(): Response
    {  
        $prestations = $this->getDoctrine()->getRepository(Prestations::class)->findAll();
        return $this->render('prestation/index.html.twig', [
            'controller_name' => '',
            'prestations' => $prestations,
        ]);
    }
}
