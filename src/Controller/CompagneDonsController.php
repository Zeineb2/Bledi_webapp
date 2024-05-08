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
use TCPDF;

#[Route('/compagne/dons')]
class CompagneDonsController extends AbstractController
{
    #[Route('/', name: 'app_compagne_dons_index', methods: ['GET'])]
public function index(CompagneDonsRepository $compagneDonsRepository): Response
{
    $compagneDons = $compagneDonsRepository->findAllWithTotalAmount();
    $comps=$compagneDonsRepository->findAll();
    
    return $this->render('compagne_dons/index.html.twig', [
        'compagneDon' => $compagneDons,
        'comps' => $comps
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

    #[Route('/{id}/pdf', name: 'app_compagne_dons_pdf', methods: ['GET'])]
    public function generatePdf(CompagneDons $compagneDon): Response
    {$pdf = new TCPDF();

        // Set document information
        $pdf->SetCreator('Your Name');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Your Title');
        
        // Set background color
        $pdf->SetFillColor(204, 229, 255); // Light blue color
        
        // Ajouter une page
        $pdf->AddPage();
        
        // Définir la police
        $pdf->SetFont('helvetica', '', 15);
        
        // Define CSS styles
        $html = '<style>';
        $html .= 'table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }';
        $html .= 'th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }'; // Center-align items
        $html .= 'th { background-color: #f2f2f2; color: red; }'; // Red color for titles
        $html .= '.title { color: black; font-size: 18px; margin-bottom: 10px; }'; // Green color for small title
        $html .= '</style>';
        
        $html .= '<div class="title">Bledi</div>'; // Small title "Bledi" in green color
        $html .= '<h1 style="color: red; text-align: center;">CompagneDons</h1>'; // Red color for title and center-align
        $html .= '<table>';
        $html .= '<tr><th>ID</th><th>Date_d</th><th>Date_f</th><th>Montant_e</th><th>Descrip</th></tr>';
        $html .= '<tr>';
        $html .= '<td>' . $compagneDon->getId() . '</td>';
        $html .= '<td>' . ($compagneDon->getDateD() ? $compagneDon->getDateD()->format('Y-m-d') : '') . '</td>';
        $html .= '<td>' . ($compagneDon->getDateF() ? $compagneDon->getDateF()->format('Y-m-d') : '') . '</td>';
        $html .= '<td>' . $compagneDon->getMontantE() . '</td>';
        $html .= '<td>' . $compagneDon->getDescrip() . '</td>';
        $html .= '</tr>';
        $html .= '</table>';
        
        // Ajouter les détails des dons dans un tableau
        $html .= '<h2 style="color: red; text-align: center;">Liste des Dons</h2>'; // Red color for title and center-align
        $html .= '<table>';
        $html .= '<tr><th>Montant_don</th><th>Mail_don</th><th>CIN_don</th></tr>';
        foreach ($compagneDon->getDons() as $don) {
            $html .= '<tr>';
            $html .= '<td>' . $don->getMontantDon() . '</td>';
            $html .= '<td>' . $don->getMailDon() . '</td>';
            $html .= '<td>' . $don->getCINDon() . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';


// Ajouter le contenu HTML au PDF
$pdf->writeHTML($html);
        // Fermer et retourner le PDF
        return new Response($pdf->Output('liste des dons .pdf', 'D'));
    }
    
}


