<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    #[Route("/about", name:"app_about")]
    public function about(): Response
    {
        return new Response("Poulet");
    }

    #[Route('/api/poulet', name:'api_poulet')]
    public function poulet_api()
    {
        return $this->json(["truc" => "machin"]);
    }

}
