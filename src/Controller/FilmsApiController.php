<?php

namespace App\Controller;

use App\Entity\Film;
use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/films')]
class FilmsApiController extends AbstractController
{
    #[Route('', name: 'api_films', methods: ["GET"])]
    public function index(FilmRepository $filmRepository): Response
    {
        $films = $filmRepository->findAll();
        return $this->json($films);
    }

    #[Route('', name: 'api_films_create', methods: ["POST"])]
    public function create(Request $request, FilmRepository $filmRepository, ValidatorInterface $validatorInterface): Response
    {
        $data = json_decode($request->getContent(), true);
        $film = new Film();
        $film->setTitre($data['titre']);
        $film->setDateSortie(new \DateTime($data['dateSortie']));
        $film->setProducteur($data['producteur']);

        // Opérateur null coalesce ??
        $film->setDescription($data["description"] ?? null);
        // avec ternaire
        // $film->setDescription($request->get("description") ? $request->get("description") : null);

        // validation de l'objet
        $errors = $validatorInterface->validate($film);

        // si le validateur remonte une erreur
        if(count($errors) > 0){
            // renvoie le message d'erreur
            return $this->json(["message" => (string) $errors], 400);
        }

        $filmRepository->add($film, true);

        return $this->json($film);
    }

    #[Route('/{id}', name: 'api_films_show', methods: ["GET"])]
    public function show(int $id, FilmRepository $filmRepository): Response
    {
        $film = $filmRepository->find($id);
        if($film){
            return $this->json($film);
        }
        return $this->json(null, 404);
    }

    #[Route('/{id}', name: 'api_films_update', methods: ["PUT"])]
    public function update($id, Request $request, FilmRepository $filmRepository): Response
    {
        // extraction du json de la requête
        $data = json_decode($request->getContent(), true);

        // récup du film à modifier
        $film = $filmRepository->find($id);

        if ($film) {
            // changements à appliquer
            $film->setTitre($data['titre']);
            $film->setProducteur($data['producteur']);
            $film->setDateSortie(new \DateTime($data['dateSortie']));
            $film->setDescription($data['description'] ?? $film->getDescription());
        } else {
            // throw $this->createNotFoundException();
            return $this->json(null, 404);
        }

        $filmRepository->add($film, true);
        // $filmRepository->update($film, true);

        return $this->json($film);
    }

    #[Route('/{id}', name: 'api_films_patch', methods: ["PATCH"])]
    public function shallow_update($id, Request $request, FilmRepository $filmRepository): Response
    {
        // extraction du json de la requête
        $data = json_decode($request->getContent(), true);

        // récup du film à modifier
        $film = $filmRepository->find($id);

        if ($film) {
            $film->setTitre($data['titre'] ?? $film->getTitre());
            $film->setProducteur($data['producteur'] ?? $film->getProducteur());
            $film->setDateSortie(isset($data['dateSortie']) ? new \DateTime($data['dateSortie']) : $film->getDateSortie());
            $film->setDescription($data['description'] ?? $film->getDescription());
        } else {
            return $this->json(null, 404);
        }

        $filmRepository->add($film, true);
        // $filmRepository->update($film, true);

        return $this->json($film);
    }

    #[Route('/{id}', name: 'api_films_delete', methods: ["DELETE"])]
    public function delete(int $id, FilmRepository $filmRepository): Response
    {
        $film = $filmRepository->find($id);
        if($film){
            $filmRepository->remove($film, true);
            return $this->json(null, 204);
        }
        return $this->json(null, 404);
    }
}
