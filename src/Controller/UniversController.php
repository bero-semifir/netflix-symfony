<?php

namespace App\Controller;

use App\Entity\Univers;
use App\Form\UniversType;
use App\Repository\UniversRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/univers')]
class UniversController extends AbstractController
{
    #[Route('/', name: 'app_univers_index', methods: ['GET'])]
    public function index(UniversRepository $universRepository): Response
    {
        return $this->render('univers/index.html.twig', [
            'univers' => $universRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_univers_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UniversRepository $universRepository): Response
    {
        $univer = new Univers();
        $form = $this->createForm(UniversType::class, $univer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $universRepository->add($univer, true);

            return $this->redirectToRoute('app_univers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('univers/new.html.twig', [
            'univer' => $univer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_univers_show', methods: ['GET'])]
    public function show(Univers $univer): Response
    {
        return $this->render('univers/show.html.twig', [
            'univer' => $univer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_univers_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Univers $univer, UniversRepository $universRepository): Response
    {
        $form = $this->createForm(UniversType::class, $univer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $universRepository->add($univer, true);

            return $this->redirectToRoute('app_univers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('univers/edit.html.twig', [
            'univer' => $univer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_univers_delete', methods: ['POST'])]
    public function delete(Request $request, Univers $univer, UniversRepository $universRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$univer->getId(), $request->request->get('_token'))) {
            $universRepository->remove($univer, true);
        }

        return $this->redirectToRoute('app_univers_index', [], Response::HTTP_SEE_OTHER);
    }
}
