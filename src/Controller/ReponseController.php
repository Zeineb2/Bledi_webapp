<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reponse;
use App\Entity\Reclamations;
use App\Form\ReponseType;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\MailerService; 
use Symfony\Component\Mime\Email;  
use DateTime;

use Symfony\Component\Mailer\MailerInterface;

class ReponseController extends AbstractController
{
    #[Route('/Reponse', name: 'app_Reponse')]
    public function index(): Response
    {
        $entitymanager = $this->getDoctrine()->getManager();
        $reponses = $entitymanager->getRepository(Reponse::class)->findAll();

        return $this->render('Reponse/index.html.twig', [
            'reponses' => $reponses,
        ]);
    }
    // #[Route('/categs/front', name: 'app_Reponse')]
    // public function indexf(): Response
    // {
    //     $entitymanager = $this->getDoctrine()->getManager();
    //     $categs = $entitymanager->getRepository(Reponse::class)->findAll();

    //     return $this->render('Reponse/indexf.html.twig', [
    //         'categs' => $categs,
    //     ]);
    // }
    #[Route('/addrep/{id}', name: 'add_Reponse',methods:["GET","POST"])]
    public function save(Request $request,int $id,MailerService $mailer): Response
    {
        
        $rep = new Reponse();
        $form = $this->createForm(ReponseType::class, $rep);
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $rec=$entityManager->getRepository(Reclamations::class)->find($id);
            $rep->setReclamations($rec);
            $rep->setDate(new \DateTime());
            $entityManager->persist($rep);
            $entityManager->flush();
            $mailer->sendEmail();
 
            return $this->redirectToRoute('app_Reponse', [], Response::HTTP_SEE_OTHER);
        }
 
        return $this->renderForm('Reponse/new.html.twig', [
            'rep' => $rep,
            'form' => $form,
        ]);
    }
    #[Route('/editReponse/{id}', name: 'edit_Reponse',methods:["GET","POST"])]
    public function edit(Request $request, EntityManagerInterface $entityManager,int $id): Response
    {
        $rep=$entityManager->getRepository(Reponse::class)->find($id);
        $form = $this->createForm(ReponseType::class, $rep);
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
 
            return $this->redirectToRoute('app_Reponse', [], Response::HTTP_SEE_OTHER);
        }
 
        return $this->renderForm('Reponse/edit.html.twig', [
            'rep' => $rep,
            'form' => $form,
        ]);
    }
    #[Route('/deleteReponse/{id}', name: 'delete_Reponse')]
    public function delete(Request $request, int $id): Response
    {
            $entityManager = $this->getDoctrine()->getManager();
            $rep=$entityManager->getRepository(Reponse::class)->find($id);
            $entityManager->remove($rep);
            $entityManager->flush();
        return $this->redirectToRoute('app_Reponse');
    }

}
