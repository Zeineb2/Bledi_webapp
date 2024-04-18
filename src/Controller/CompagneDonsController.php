<?php

namespace App\Controller;

use App\Entity\CompagneDons;
use App\Form\CompagneDonsType;
use App\Repository\CompagneDonsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/compagne/dons')]
class CompagneDonsController extends AbstractController
{
    #[Route('/', name: 'app_compagne_dons_index', methods: ['GET'])]
    public function index(CompagneDonsRepository $compagneDonsRepository): Response
    {

        return $this->render('compagne_dons/index.html.twig', [
            //'compagne_dons' => $compagneDonsRepository->findAll(),
            'compagne_dons' => $compagneDonsRepository->findAllWithTotalAmount(),
        ]);
    }

    #[Route('/new', name: 'app_compagne_dons_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $compagneDon = new CompagneDons();
        $form = $this->createForm(CompagneDonsType::class, $compagneDon);
        $form->handleRequest($request);

       /* if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($compagneDon);
            $entityManager->flush();

            return $this->redirectToRoute('app_compagne_dons_index', [], Response::HTTP_SEE_OTHER);
        }**/
        if ($form->isSubmitted() && $form->isValid()) {
            // Vérification que la date de début est avant la date de fin
            if ($compagneDon->getDateD() >= $compagneDon->getDateF()) {
                $this->addFlash('error', 'La date de début doit être antérieure à la date de fin.');
               return $this->redirectToRoute('app_compagne_dons_new');
            }

            // Vérification que le montant estimé est supérieur à 5000 DT
            else if ($compagneDon->getMontantE() <= 5000) {
                $this->addFlash('error', 'Le montant estimé doit être supérieur à 5000 DT.');
                return $this->redirectToRoute('app_compagne_dons_new');
            }
else {
            $entityManager->persist($compagneDon);
            $entityManager->flush();

            return $this->redirectToRoute('app_compagne_dons_index', [], Response::HTTP_SEE_OTHER);
        }
    }

        return $this->renderForm('compagne_dons/new.html.twig', [
            'compagne_don' => $compagneDon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compagne_dons_show', methods: ['GET'])]
    public function show(CompagneDons $compagneDon): Response
    {
        return $this->render('compagne_dons/show.html.twig', [
            'compagne_don' => $compagneDon,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_compagne_dons_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CompagneDons $compagneDon, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CompagneDonsType::class, $compagneDon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_compagne_dons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('compagne_dons/edit.html.twig', [
            'compagne_don' => $compagneDon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compagne_dons_delete', methods: ['POST'])]
    public function delete(Request $request, CompagneDons $compagneDon, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compagneDon->getId(), $request->request->get('_token'))) {
            $entityManager->remove($compagneDon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_compagne_dons_index', [], Response::HTTP_SEE_OTHER);
    }
}
