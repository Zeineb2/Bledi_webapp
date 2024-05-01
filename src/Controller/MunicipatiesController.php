<?php

namespace App\Controller;

use App\Entity\Municipaties;
use App\Form\MunicipatiesType;
use App\Repository\MunicipatiesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

#[Route('/municipaties')]
class MunicipatiesController extends AbstractController
{
    #[Route('/', name: 'app_municipaties_index', methods: ['GET'])]
    public function index(MunicipatiesRepository $municipatiesRepository): Response
    {
        $municipaties = $municipatiesRepository->findAll();

        // Count the number of municipalities for each state
        $statistics = [];
        foreach ($municipaties as $municipaty) {
            $state = $municipaty->getEtatMuni();
            if (!isset($statistics[$state])) {
                $statistics[$state] = 1;
            } else {
                $statistics[$state]++;
            }
        }

        return $this->render('municipaties/index.html.twig', [
            'municipaties' => $municipaties,
            'statistics' => $statistics,
        ]);
    }
    
    #[Route('/front', name: 'app_municipaties_front_index')]
    public function frontIndex(MunicipatiesRepository $municipatiesRepository): Response
    {
        return $this->render('municipaties/front.html.twig', [
            'municipaties' => $municipatiesRepository->findAll(),
        ]);
    }
    #[Route('/new', name: 'app_municipaties_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SessionInterface $session ): Response
    {
        $municipaty = new Municipaties();
        $form = $this->createForm(MunicipatiesType::class, $municipaty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($municipaty);
            $entityManager->flush();
          // Set flash message
            $session->getFlashBag()->add('success', 'Solution added successfully!');
            return $this->redirectToRoute('app_municipaties_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('municipaties/new.html.twig', [
            'municipaty' => $municipaty,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_municipaties_show', methods: ['GET'])]
    public function show(Municipaties $municipaty): Response
    {
        return $this->render('municipaties/show.html.twig', [
            'municipaty' => $municipaty,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_municipaties_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Municipaties $municipaty, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MunicipatiesType::class, $municipaty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_municipaties_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('municipaties/edit.html.twig', [
            'municipaty' => $municipaty,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_municipaties_delete', methods: ['POST'])]
    public function delete(Request $request, Municipaties $municipaty, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$municipaty->getId(), $request->request->get('_token'))) {
            $entityManager->remove($municipaty);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_municipaties_index', [], Response::HTTP_SEE_OTHER);
    }

    
}
