<?php

namespace App\Controller;

use App\Entity\Dons;
use App\Form\DonsType;
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
    public function index(Request $request, CompagneDonsRepository $compagneDonsRepository): Response
    {
        // Pagination
        $searchTerm = $request->query->get('searchTerm');
        $compagneDons = ($searchTerm) ? $compagneDonsRepository->findByFullTextSearch($searchTerm) : $compagneDonsRepository->findAll();
    
        $totalItems = count($compagneDons);
        $itemsPerPage = 3;
        $totalPages = max(1, ceil($totalItems / $itemsPerPage));
        $currentPage = $request->query->getInt('currentPage', 1);
        $currentPage = max(1, min($currentPage, $totalPages));
        $offset = ($currentPage - 1) * $itemsPerPage;
        $pagecomp = array_slice($compagneDons, $offset, $itemsPerPage);
    
        return $this->render('compagnefront/index.html.twig', [
            'compagne_dons' => $pagecomp,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'searchTerm' => $searchTerm,
        ]);
    }
    
    #[Route('compagnedons/{id}', name: 'app_compagnefront_donner', methods: ['GET','POST'])]
    public function show(string $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Find the CompagneDons object by id
        $compagneDon = $entityManager->getRepository(CompagneDons::class)->find($id);
    
        // Check if the CompagneDons object is found
        if (!$compagneDon) {
            throw $this->createNotFoundException('CompagneDons object not found');
        }
    
        $don = new Dons();
    
        $form = $this->createForm(DonsType::class, $don);
        $form->handleRequest($request);
        $don->setCompagne($compagneDon);
       
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['virement_img']->getData();
            $don->setVirementImg("aa");
            // Convert uploaded image to base64
            if ($file) {
                // Convertir l'image base64 en binaire
                $base64Image = base64_encode(file_get_contents($file->getPathname()));
    
                // Enregistrer l'image binaire dans l'entité
                $don->setVirementImg($base64Image);
            }
    
            // Store base64 image in your entity
            // $don->setVirementImg($base64Image);
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

   

    /*
    #[Route('/compagnes', name: 'compagnes')]
    public function list(Request $request): Response
    {
        $page = $request->query->getInt('page', 1); // Récupérer le numéro de page à partir de la requête
        $compagnesPerPage = 4; // Nombre de compagnes de dons par page
        $offset = ($page - 1) * $compagnesPerPage; // Calculer l'offset en fonction du numéro de page
        $compagnesRepository = $this->getDoctrine()->getRepository(CompagneDons::class);
        $totalCompagnes = $compagnesRepository->count([]); // Nombre total de compagnes de dons
        $totalPages = ceil($totalCompagnes / $compagnesPerPage); // Nombre total de pages
    
        $compagnes = $compagnesRepository->findBy([], null, $compagnesPerPage, $offset); // Récupérer les compagnes de dons paginées depuis la base de données
    
        return $this->render('compagnes/index.html.twig', [
            'compagnes' => $compagnes,
            'currentPage' => $page, // Passer le numéro de page actuel à la vue
            'totalPages' => $totalPages, // Passer le nombre total de pages à la vue
        ]);
    }
    */
}