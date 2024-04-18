<?php

namespace App\Controller;
use App\Entity\Dons;
use App\Form\DonsType;
use App\Repository\DonsRepository;
use App\Entity\CompagneDons;
use App\Form\CompagneDonsType;
use App\Repository\CompagneDonsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompagnefrontController extends AbstractController
{
    #[Route('/compagnefront', name: 'app_compagnefront')]
    public function index(CompagneDonsRepository $compagneDonsRepository): Response
    {
        return $this->render('compagnefront/index.html.twig', [
            //'compagne_dons' => $compagneDonsRepository->findAll(),
            'compagne_dons' => $compagneDonsRepository->findAllWithTotalAmount(),
        ]);
    }
    #[Route('/{id}', name: 'app_compagnefront_donner', methods: ['GET','POST'])]
    public function show(CompagneDons $compagneDon,Request $request, EntityManagerInterface $entityManager): Response
    {
        $don = new Dons();
        $form = $this->createForm(DonsType::class, $don);
        $form->handleRequest($request);
        $don->setCompagne($compagneDon);
        if ($form->isSubmitted() && $form->isValid()) {

            $don->setCompagne($compagneDon);
            $entityManager->persist($don);
            $entityManager->flush();

            return $this->redirectToRoute('app_compagnefront', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('compagnefront/donner.html.twig', [
            'compagne_don' => $compagneDon,
            'don' => $don,
            'form' => $form->createView(),
        ]);



       

        
    }

  
}
