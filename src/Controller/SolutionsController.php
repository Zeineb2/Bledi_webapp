<?php

namespace App\Controller;

use App\Entity\Solutions;
use App\Repository\SolutionsRepository;
use App\Form\SolutionsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

#[Route('/solutions')]
class SolutionsController extends AbstractController
{
    #[Route('/', name: 'app_solutions_index', methods: ['GET'])]
    public function index(SolutionsRepository $solutionsRepository): Response
    {
        $solutions = $solutionsRepository->findAll();

        // Initialize an empty array to hold the statistics
        $statistics = [];

        // Loop through each solution
        foreach ($solutions as $solution) {
            // Get the state for the current solution
            $state = $solution->getEtatSol(); // Assuming you have a method like getState() to get the state

            // Check if the state exists in the statistics array
            if (!isset($statistics[$state])) {
                // If it doesn't exist, initialize it with count 1
                $statistics[$state] = 1;
            } else {
                // If it exists, increment the count
                $statistics[$state]++;
            }
        }

        return $this->render('solutions/index.html.twig', [
            'solutions' => $solutions,
            'statistics' => $statistics,
        ]);
    }

    #[Route('/new', name: 'app_solutions_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $solution = new Solutions();
        $form = $this->createForm(SolutionsType::class, $solution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Check if date debut comes after date fin
            if ($solution->getDatedSol() > $solution->getDatefSol()) {
                // Set flash message for error
                $session->getFlashBag()->add('error', 'Date debut cannot come after date fin.');
                return $this->redirectToRoute('app_solutions_new');
            }

            $entityManager->persist($solution);
            $entityManager->flush();

            // Set flash message
            $session->getFlashBag()->add('success', 'Solution added successfully!');

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

    #[Route('/{idSol}/pdf', name: 'app_solutions_pdf', methods: ['GET'])]
    public function generatePdf(Solutions $solution): Response
    {
        // Render the Twig template to HTML
        $html = $this->renderView('solutions/pdf_template.html.twig', [
            'solution' => $solution,
        ]);

        // Configure Dompdf options
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->set('isHtml5ParserEnabled', true);
        $pdfOptions->set('isPhpEnabled', true);

        // Instantiate Dompdf with configured options
        $dompdf = new Dompdf($pdfOptions);

        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size (A4)
        $dompdf->setPaper('A4', 'portrait');

        // Render HTML to PDF
        $dompdf->render();

        // Get PDF content
        $output = $dompdf->output();

        // Stream the PDF content as a response
        $response = new Response($output);
        $response->headers->set('Content-Type', 'application/pdf');

        return $response;
    }
}