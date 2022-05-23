<?php

namespace App\Controller;

use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/films')]
class FilmsController extends AbstractController
{
    #[Route('/', name: 'app_films', methods:["GET"])]
    public function index(FilmRepository $filmRepository): Response
    {
        // Appel du repository pour obtenir la liste des films
        $films = $filmRepository->findAll();
        return $this->render('films/index.html.twig', [
            'films' => $films
        ]);
    }
}
