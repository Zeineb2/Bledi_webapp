<?php

namespace App\Controller;

use App\Entity\Idee;
use App\Repository\IdeeRepository;
use App\Form\IdeeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twilio\Rest\Client;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Form\FormError;



#[Route('/idee')]
class IdeeController extends AbstractController
{
    #[Route('/', name: 'app_idee_index', methods: ['GET'])]
    public function index(IdeeRepository $ideeRepository): Response
    {
        return $this->render('idee/index.html.twig', [
            'idees' => $ideeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_idee_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
        $idee = new Idee();
        $form = $this->createForm(IdeeType::class, $idee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Validate against bad words
            $description = $idee->getDescriptionIdee();
            if ($this->containsBadWords($description)) {
                $form->get('descriptionIdee')->addError(new FormError('The description contains forbidden words.'));
                return $this->renderForm('idee/new.html.twig', [
                    'idee' => $idee,
                    'form' => $form,
                ]);
            }

            $entityManager->persist($idee);
            $entityManager->flush();

            // Call sendTwilioMessage method after idea is added
            $this->sendTwilioMessage($idee);

            return $this->redirectToRoute('app_idee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('idee/new.html.twig', [
            'idee' => $idee,
            'form' => $form,
        ]);
    }

    // Function to check for bad words
    private function containsBadWords(string $description): bool
    {
        $forbiddenWords = ['bad word', 'fuck', 'bitch']; // Add your list of forbidden words here
        foreach ($forbiddenWords as $word) {
            if (stripos($description, $word) !== false) {
                return true;
            }
        }
        return false;
    }

    #[Route('/{idIdee}', name: 'app_idee_show', methods: ['GET'])]
    public function show(Idee $idee): Response
    {
        return $this->render('idee/show.html.twig', [
            'idee' => $idee,
        ]);
    }

    #[Route('/{idIdee}/edit', name: 'app_idee_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Idee $idee, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(IdeeType::class, $idee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_idee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('idee/edit.html.twig', [
            'idee' => $idee,
            'form' => $form,
        ]);
    }

    #[Route('/{idIdee}', name: 'app_idee_delete', methods: ['POST'])]
    public function delete(Request $request, Idee $idee, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$idee->getIdIdee(), $request->request->get('_token'))) {
            $entityManager->remove($idee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_idee_index', [], Response::HTTP_SEE_OTHER);
    }

    // Function to send a Twilio SMS when a new idea is added
    private function sendTwilioMessage(Idee $idee): void
    {
        // Get Twilio credentials from Symfony parameters
        $twilioAccountSid = $this->getParameter('twilio_account_sid');
        $twilioAuthToken = $this->getParameter('twilio_auth_token');
        $twilioPhoneNumber = $this->getParameter('twilio_phone_number');

        // Initialize Twilio client
        $twilioClient = new Client($twilioAccountSid, $twilioAuthToken);

        // Send message using Twilio client
        $twilioClient->messages->create(
            '+21652922478', // Replace with the recipient phone number
            [
                'from' => $twilioPhoneNumber,
                'body' => 'A new idea has been added: ' . $idee->getDescriptionIdee(), // Customize the message body as needed
            ]
        );
    }


}