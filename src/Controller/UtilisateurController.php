<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use twilio\Rest\Client;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Service\TwilioService;

#[Route('/utilisateur')]
class UtilisateurController extends AbstractController
{
    #[Route('/', name: 'app_utilisateur_index', methods: ['GET'])]
    public function index(UtilisateurRepository $utilisateurRepository): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'utilisateurs' => $utilisateurRepository->findAll(),
        ]);
    }
    private $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }

    #[Route('/new', name: 'app_utilisateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            $this->twilioService->sendWelcomeMessage($utilisateur->getTel());
            return $this->redirectToRoute('app_utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('utilisateur/new.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,

        ]);
    }

    #[Route('/{cin}', name: 'app_utilisateur_show', methods: ['GET'])]
    public function show(Utilisateur $utilisateur): Response
    {
        return $this->render('utilisateur/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    #[Route('/{cin}/edit', name: 'app_utilisateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('utilisateur/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{cin}', name: 'app_utilisateur_delete', methods: ['POST'])]
    public function delete(Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$utilisateur->getCin(), $request->request->get('_token'))) {
            $entityManager->remove($utilisateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_utilisateur_index', [], Response::HTTP_SEE_OTHER);
    }
    private function sendSMS(string $number,string $name, string $text): void
    {
        $twilioAccountSid = $_ENV['twilio_account_sid'];
        $twilioAuthToken = $_ENV['twilio_auth_token'];
        $twilioPhoneNumber = $_ENV['twilio_phone_number'];

        $twilioClient = new Client($twilioAccountSid, $twilioAuthToken);


        $twilioClient->messages->create(
            '+21655949459', //// badel enum  mtaaak
            [
                'from' => $twilioPhoneNumber,
                'body' => 'Un utilisateur vient de s inscrire ' ,
                    
            ]
        );
    }

    #[Route('/pdf/{cin}', name: 'app_utilisateur_pdf', methods: ['GET'])]
    public function generatePdf(Utilisateur $utilisateur): Response
    {
        // Récupérer le contenu HTML du template Twig
        $html = $this->renderView('utilisateur/pdf_template.html.twig', [
            'utilisateur' => $utilisateur,
        ]);

        // Options de configuration pour Dompdf
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Créer une instance de Dompdf avec les options
        $dompdf = new Dompdf($pdfOptions);
        $dompdf->loadHtml($html);

        // Définir le format de papier (A4)
        $dompdf->setPaper('A4', 'portrait');

        // Rendre le HTML en PDF
        $dompdf->render();

        // Récupérer le contenu PDF généré
        $output = $dompdf->output();

        // Créer une réponse avec le contenu PDF et le type de contenu approprié
        $response = new Response($output);
        $response->headers->set('Content-Type', 'application/pdf');

        // Retourner la réponse
        return $response;
    }

}
