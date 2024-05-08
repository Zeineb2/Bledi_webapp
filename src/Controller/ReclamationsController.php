<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reclamations;
use App\Repository\ReclamationsRepository;
use App\Form\ReclamationsType;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Twilio\Rest\Client;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Reclamation;

class ReclamationsController extends AbstractController
{
   

// Initialisation du client Twilio


    #[Route('/reclamations', name: 'app_reclamations')]
    public function index(): Response
    {
        $entitymanager = $this->getDoctrine()->getManager();
        $reclamations = $entitymanager->getRepository(Reclamations::class)->findAll();

        return $this->render('Reclamations/index.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }
    #[Route('/trier', name: 'app_reclamations_tri')]
    public function tri(ReclamationsRepository $repo): Response
    {
        //$entitymanager = $this->getDoctrine()->getManager();
        $reclamations = $repo->findByPriority();

        return $this->render('Reclamations/index.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }
    // #[Route('/categs/front', name: 'app_Reclamations')]
    // public function indexf(): Response
    // {
    //     $entitymanager = $this->getDoctrine()->getManager();
    //     $categs = $entitymanager->getRepository(Reclamations::class)->findAll();

    //     return $this->render('Reclamations/indexf.html.twig', [
    //         'categs' => $categs,
    //     ]);
    // }
        #[Route('/addrec', name: 'add_reclamations',methods:["GET","POST"])]
        public function save(Request $request,NotifierInterface $notifier,ReclamationsRepository $service): Response
        {
            
            $rec = new Reclamations();
            $form = $this->createForm(ReclamationsType::class, $rec);
            $form->handleRequest($request);
            $myDictionary = array(
                "tue", "merde", "pute",
                "gueule",
                "débile",
                "con",
                "abruti",
                "clochard",
                "sang"
            );
    
            if ($form->isSubmitted() && $form->isValid()) {
                $file = $form->get('imgRec')->getData();
                $filename = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('uploads'),$filename);
                $rec->setPhoto($filename);
                $rec->setDate(new \DateTime());
                $myText = $request->get("reclamations")['localisationRec'];
                $badwords = new PhpBadWordsController();
                $badwords->setDictionaryFromArray($myDictionary)
                    ->setText($myText);
                $check = $badwords->check();
                dump($check);
                if ($check) {
                    $notifier->send(new Notification('Mauvais mot ', ['browser'])); }
                
                else{
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($rec);
                $entityManager->flush();
                //$service->sms();
    
                return $this->redirectToRoute('app_reclamations', [], Response::HTTP_SEE_OTHER);
                }
            
            }
            return $this->renderForm('Reclamations/new.html.twig', [
                'rec' => $rec,
                'form' => $form,
            ]);
        }
    #[Route('/editReclamations/{id}', name: 'edit_reclamations',methods:["GET","POST"])]
    public function edit(Request $request, EntityManagerInterface $entityManager,int $id): Response
    {
        $rec=$entityManager->getRepository(Reclamations::class)->find($id);
        $form = $this->createForm(ReclamationsType::class, $rec);
        $form->handleRequest($request);
        
 
        if ($form->isSubmitted() && $form->isValid()) {
            $photo = $form->get('imgRec')->getData();
            $image = md5(uniqid()).'.'.$photo->guessExtension();
            $photo->move(
                $this->getParameter('uploads'),
                $image);
                $rec->setPhoto($image);
               
             
            $this->getDoctrine()->getManager()->flush();
 
            return $this->redirectToRoute('app_reclamations', [], Response::HTTP_SEE_OTHER);
        }
 
        return $this->renderForm('reclamations/edit.html.twig', [
            'rec' => $rec,
            'form' => $form,
        ]);
    }
    #[Route('/deleteReclamations/{id}', name: 'delete_reclamations')]
    public function delete(Request $request, int $id): Response
    {
            $entityManager = $this->getDoctrine()->getManager();
            $rec=$entityManager->getRepository(Reclamations::class)->find($id);
            $entityManager->remove($rec);
            $entityManager->flush();
        return $this->redirectToRoute('app_reclamations');
    }
    
    // public function sendSms($phone,$brandName,$message){
    //     $basic  = new \Vonage\Client\Credentials\Basic("bb5f8701", "u9zRzmNvwDvjsRLg");
    //     $client = new \Vonage\Client($basic);

    //         $response = $client->sms()->send(
    //             new \Vonage\SMS\Message\SMS( $phone , $brandName, $message)
    //         );

    //         $message = $response->current();

    //         if ($message->getStatus() == 0) {
    //             echo "The message was sent successfully\n";
    //         } else {
    //             echo "The message failed with status: " . $message->getStatus() . "\n";
    //         }
        
        
        
    // }
    #[Route('/pdf/{ID_rec}', name: 'app_reclamations_pdf', methods: ['GET'])]
    public function generatePdf(Reclamation $reclamation): Response
    {
        // Render the Twig template to HTML
        $html = $this->renderView('reclamations/pdf_template.html.twig', [
            'reclamation' => $reclamation,
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
