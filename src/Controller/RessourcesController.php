<?php

namespace App\Controller;

use App\Entity\Ressources;
use App\Form\RessourcesType;
use App\Repository\RessourcesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Vich\UploaderBundle\Form\Type\VichImageType;

#[Route('/ressources')]
class RessourcesController extends AbstractController
{
    #[Route('/', name: 'app_ressources_index', methods: ['GET'])]
    public function index(RessourcesRepository $ressourcesRepository): Response
    {
        return $this->render('ressources/index.html.twig', [
            'ressources' => $ressourcesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ressources_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $entityManager): Response
{
    $ressource = new Ressources();
    $form = $this->createForm(RessourcesType::class, $ressource);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Handle file upload using VichUploaderBundle
        $entityManager->persist($ressource);
        $entityManager->flush();

        return $this->redirectToRoute('app_ressources_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('ressources/new.html.twig', [
        'ressource' => $ressource,
        'form' => $form->createView(),
    ]);
}

    #[Route('/{idRessource}', name: 'app_ressources_show', methods: ['GET'])]
    public function show(Ressources $ressource): Response
    {
        return $this->render('ressources/show.html.twig', [
            'ressource' => $ressource,
        ]);
    }

    #[Route('/{idRessource}/edit', name: 'app_ressources_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ressources $ressource, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RessourcesType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_ressources_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ressources/edit.html.twig', [
            'ressource' => $ressource,
            'form' => $form,
        ]);
    }

    #[Route('/{idRessource}', name: 'app_ressources_delete', methods: ['POST'])]
    public function delete(Request $request, Ressources $ressource, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ressource->getIdRessource(), $request->request->get('_token'))) {
            $entityManager->remove($ressource);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_ressources_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{idRessource}/pdf', name: 'app_ressource_pdf', methods: ['GET'])]
    public function generatePdf(Ressources $ressource): Response
    {
        // Render the Twig template to HTML
        $html = $this->renderView('ressources/pdf_template.html.twig', [
            'ressource' => $ressource,
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
