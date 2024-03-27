<?php

namespace App\Controller;

use App\Entity\Solutions;
use App\Form\SolutionsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/solutions')]
class SolutionsController extends AbstractController
{
    #[Route('/', name: 'app_solutions_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $solutions = $entityManager
            ->getRepository(Solutions::class)
            ->findAll();

        return $this->render('solutions/index.html.twig', [
            'solutions' => $solutions,
        ]);
    }

    #[Route('/new', name: 'app_solutions_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $solution = new Solutions();
        $form = $this->createForm(SolutionsType::class, $solution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($solution);
            $entityManager->flush();

            return $this->redirectToRoute('app_solutions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('solutions/new.html.twig', [
            'solution' => $solution,
            'form' => $form,
        ]);
    }

    #[Route('/{idSol}', name: 'app_solutions_show', methods: ['GET'])]
    public function show(Solutions $solution): Response
    {
        return $this->render('solutions/show.html.twig', [
            'solution' => $solution,
        ]);
    }

    #[Route('/{idSol}/edit', name: 'app_solutions_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Solutions $solution, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SolutionsType::class, $solution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_solutions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('solutions/edit.html.twig', [
            'solution' => $solution,
            'form' => $form,
        ]);
    }

    #[Route('/{idSol}', name: 'app_solutions_delete', methods: ['POST'])]
    public function delete(Request $request, Solutions $solution, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$solution->getIdSol(), $request->request->get('_token'))) {
            $entityManager->remove($solution);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_solutions_index', [], Response::HTTP_SEE_OTHER);
    }
}
