<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorierec;
use App\Form\CategorierecType;
use Doctrine\ORM\EntityManagerInterface;

class CategorierecController extends AbstractController
{
    #[Route('/categories', name: 'app_categorierec')]
    public function index(): Response
    {
        $entitymanager = $this->getDoctrine()->getManager();
        $categs = $entitymanager->getRepository(Categorierec::class)->findAll();

        return $this->render('Categorierec/index.html.twig', [
            'categs' => $categs,
        ]);
    }
    // #[Route('/categs/front', name: 'app_Categorierec')]
    // public function indexf(): Response
    // {
    //     $entitymanager = $this->getDoctrine()->getManager();
    //     $categs = $entitymanager->getRepository(Categorierec::class)->findAll();

    //     return $this->render('Categorierec/indexf.html.twig', [
    //         'categs' => $categs,
    //     ]);
    // }
    #[Route('/addcateg', name: 'add_Categorierec',methods:["GET","POST"])]
    public function save(Request $request): Response
    {
        
        $categ = new Categorierec();
        $form = $this->createForm(CategorierecType::class, $categ);
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categ);
            $entityManager->flush();
 
            return $this->redirectToRoute('app_categorierec', [], Response::HTTP_SEE_OTHER);
        }
 
        return $this->renderForm('Categorierec/new.html.twig', [
            'categ' => $categ,
            'form' => $form,
        ]);
    }
    #[Route('/edit/{id}', name: 'edit_Categorierec',methods:["GET","POST"])]
    public function edit(Request $request, EntityManagerInterface $entityManager,int $id): Response
    {
        $categ=$entityManager->getRepository(Categorierec::class)->find($id);
        $form = $this->createForm(CategorierecType::class, $categ);
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
 
            return $this->redirectToRoute('app_categorierec', [], Response::HTTP_SEE_OTHER);
        }
 
        return $this->renderForm('Categorierec/edit.html.twig', [
            'categ' => $categ,
            'form' => $form,
        ]);
    }
    #[Route('/delete/{id}', name: 'delete_Categorierec')]
    public function delete(Request $request, int $id): Response
    {
            $entityManager = $this->getDoctrine()->getManager();
            $categ=$entityManager->getRepository(Categorierec::class)->find($id);
            $entityManager->remove($categ);
            $entityManager->flush();
        return $this->redirectToRoute('app_categorierec');
    }

}
