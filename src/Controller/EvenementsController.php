<?php

namespace App\Controller;

use App\Entity\Evenements;
use App\Entity\Reservations;
use App\Form\EvenementsType;
use App\Form\ReservationsType;
use App\Repository\EvenementsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Snipe\BanBuilder\CensorWords;
use Dompdf\Dompdf;
use Dompdf\Options;

class EvenementsController extends AbstractController
{



    #[Route('/indexx', name: 'app_indexx')]
    public function indexx(): Response
    {

        return $this->render('client/index.html.twig');
    }
    #[Route('/evenements', name: 'app_evenements')]
    public function index(): Response
    {
        return $this->render('admin.html.twig', [
            'controller_name' => 'EvenementsController',
        ]);
    }
    #[Route('/add_evenements', name: 'add_evenements')]

    public function Add(Request  $request , ManagerRegistry $doctrine ,SluggerInterface $slugger, SessionInterface $session) : Response {

        $Evenements =  new Evenements() ;
        $form =  $this->createForm(EvenementsType::class,$Evenements) ;
        $form->add('Ajouter' , SubmitType::class) ;
        $form->handleRequest($request) ;


         


        if($form->isSubmitted()&& $form->isValid()){
            $brochureFile = $form->get('image')->getData();
            //$file =$Evenements->getImage();
            $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
            //$uploads_directory = $this->getParameter('upload_directory');
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();
            //$fileName = md5(uniqid()).'.'.$file->guessExtension();
            $brochureFile->move(
                $this->getParameter('upload_directory'),
                $newFilename
            );
            $Evenements->setImage(($newFilename));


        


            
            $em= $doctrine->getManager() ;
            $em->persist($Evenements);
            $em->flush();
            $evenementsName = $Evenements->getNomEvent();

        // Créer le message de notification
        $notificationMessage = "L'ajout a été effectué pour cet utilisateur, nom de la réclamation : $evenementsName";

        // Ajouter la notification à la session flash
        $session->getFlashBag()->add('success', $notificationMessage);

            return $this ->redirectToRoute('add_evenements') ;
        }
        return $this->render('evenements/addevenementss.html.twig' , [
            'form' => $form->createView()
        ]) ;
    }

    #[Route('/afficher_evenements', name: 'afficher_evenements')]
   
public function AfficheEvenements(EvenementsRepository $repo, PaginatorInterface $paginator, Request $request): Response
{
    $searchTerm = $request->query->get('search');
    $evenementss = $repo->searchByTypeOrNameOrComment($searchTerm);

    $pagination = $paginator->paginate(
        $evenementss,
        $request->query->getInt('page', 1),
        4 // items per page
    );

    return $this->render('evenements/index.html.twig', [
        'Evenements' => $pagination,
        'ajoutA' => $evenementss
    ]);
}
#[Route('/afficher_evenementsBack', name: 'afficher_evenementsBack')]
   
public function afficher_evenementsBack(EvenementsRepository $repo, PaginatorInterface $paginator, Request $request): Response
{
    $searchTerm = $request->query->get('search');
    $evenementss = $repo->searchByTypeOrNameOrComment($searchTerm);

    $Evenements=$repo->findAll() ;
    $pagination = $paginator->paginate(
        $evenementss,
        $request->query->getInt('page', 1),
        4 // items per page
    );

    return $this->render('evenements/listB.html.twig', [
        'Evenements' => $pagination,
        'ajoutA' => $evenementss
    ]);
}

    #[Route('/delete_ab/{id}', name: 'delete_ab')]
    public function Delete($id,EvenementsRepository $repository , ManagerRegistry $doctrine) : Response {
        $Evenements=$repository->find($id) ;
        $em=$doctrine->getManager() ;
        $em->remove($Evenements);
        $em->flush();
        return $this->redirectToRoute("afficher_evenements") ;

    }
    #[Route('/update_ab/{id}', name: 'update_ab')]
    function update(EvenementsRepository $repo,$id,Request $request , ManagerRegistry $doctrine,SluggerInterface $slugger){
        $Evenements = $repo->find($id) ;
        $form=$this->createForm(EvenementsType::class,$Evenements) ;
        $form->add('update' , SubmitType::class) ;
        $form->handleRequest($request) ;
        if($form->isSubmitted()&& $form->isValid()){
            $brochureFile = $form->get('image')->getData();
            //$file =$Evenements->getImage();
            $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
            //$uploads_directory = $this->getParameter('upload_directory');
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();
            //$fileName = md5(uniqid()).'.'.$file->guessExtension();
            $brochureFile->move(
                $this->getParameter('upload_directory'),
                $newFilename
            );
            $Evenements->setImage(($newFilename));

            $Evenements = $form->getData();
            $em=$doctrine->getManager() ;
            $em->flush();
            return $this ->redirectToRoute('afficher_evenements') ;
        }
        return $this->render('evenements/updateevenementss.html.twig' , [
            'form' => $form->createView()
        ]) ;

    }

 
    #[Route('/reserver/{id}', name: 'reserver')]
    
public function reserver(Request  $request , ManagerRegistry $doctrine): Response
 {
     $Reservations =  new Reservations() ;
        $form =  $this->createForm(ReservationsType::class,$Reservations) ;
        $form->add('Ajouter' , SubmitType::class) ;
        $form->handleRequest($request) ;
        if($form->isSubmitted()&& $form->isValid()){
            
            return $this ->redirectToRoute('add_Reservations') ;
        }
        return $this->render('reservations/frontadd.html.twig' , [
            'form' => $form->createView()
        ]) ;
 }
 

}


