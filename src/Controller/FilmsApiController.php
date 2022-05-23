<?php

namespace App\Controller;

use App\Entity\Film;
use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/films')]
class FilmsApiController extends AbstractController
{
    #[Route('/', name: 'api_films', methods:["GET"])]
    public function index(FilmRepository $filmRepository): Response
    {
        $films = $filmRepository->findAll();
        return $this->json($films);
    }

    #[Route('/', name: 'api_films_create', methods:["POST"])]
    public function create(Film $film): Response
    {
        return $this->json($film);
    }

    #[Route('/{id}', name: 'api_films_show', methods:["GET"])]
    public function show(int $id): Response
    {
        return $this->json($this->films[$id]);
    }

    #[Route('/{id}', name: 'api_films_update', methods:["PUT"])]
    public function update(Film $film): Response
    {
        return $this->json($film);
    }

    #[Route('/{id}', name: 'api_films_delete', methods:["DELETE"])]
    public function delete(int $id): Response
    {
        return $this->json($this->films[$id]);
    }

}
