<?php

namespace App\Controller;
use App\Entity\Avis;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvisController extends AbstractController
{
    /**
     * @Route("/avis", name="app_avis")
     */
    public function index(): Response
    {
    $repo=$this->getDoctrine()->getRepository(Avis::Class);

    $avis=$repo->findAll();
        return $this->render('avis/index.html.twig', [
            'controller_name' => 'AvisController',
            'avis'=>$avis
        ]);
    }
}
