
<?php


use App\Entity\Prestation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrestationController extends AbstractController
{/**
     * @Route("/prestation", name="app_site")
     */
    public function getPrestation(): Response
    {
        $repo=$this->getDoctrine()->getRepository(Prestations::Class);


        $prestation=$repo->findAll();
        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
            'name'=>'SiteController',
            'prestation'=>$prestation
        ]);
    }}