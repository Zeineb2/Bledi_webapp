<?php

namespace App\Controller;
use Symfony\Component\Mailer\MailerInterface;
use App\Entity\Dons;
use App\Form\DonsType;
use App\Repository\DonsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
require_once './../vendor/autoload.php';
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\VarDumper\VarDumper;
#[Route('/dons')]
class DonsController extends AbstractController
{
    #[Route('/', name: 'app_dons_index', methods: ['GET'])]
    public function index(DonsRepository $donsRepository): Response
    {
        return $this->render('dons/index.html.twig', [
            'dons' => $donsRepository->findAll(),
        ]);
    }
    #[Route('/', name: 'app_dons_ajouter', methods: ['GET'])]
    public function new(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer,ConsoleOutputInterface $output): Response
    {

        $don = new Dons();
        $form = $this->createForm(DonsType::class, $don);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            $file = ($form['Virement_img']->getData());
            console.log($file->getPathname());
            // Convert uploaded image to base64
            $base64Image = base64_encode(file_get_contents($file->getPathname()));
            console.log($base64Image);
            // Afficher le contenu de l'image convertie en base64
            dump($base64Image);
            // Store base64 image in your entity
            $don->setVirementImg("aaaa");
            $entityManager->persist($don);
            $entityManager->flush();
    

            



    
            // Créer l'e-mail
            $email = (new Email())
                ->from('bechir.bergachi@esprit.tn')
                ->to('bergachibechir58@gmail.com')
                ->subject('Nouveau don effectué')
                ->html($this->renderView('dons/mail.html.twig', ['don' => $don])); // Template HTML de l'e-mail
    
            // Envoyer l'e-mail
            $mailer->send($email);
    
            return $this->redirectToRoute('app_dons_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('dons/new.html.twig', [
            'don' => $don,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dons_delete', methods: ['POST'])]
    public function delete(Request $request, Dons $don, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$don->getId(), $request->request->get('_token'))) {
            $entityManager->remove($don);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dons_index', [], Response::HTTP_SEE_OTHER);
    }
}