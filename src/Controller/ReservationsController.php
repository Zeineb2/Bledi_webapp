<?php

namespace App\Controller;

use App\Entity\Reservations;
use App\Form\ReservationsType;
use App\Repository\ReservationsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
class ReservationsController extends AbstractController
{
    #[Route('/reservations', name: 'app_reservations')]
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'ReservationsController',
        ]);
    }
    #[Route('/add_Reservations', name: 'add_Reservations')]

    public function Add(Request  $request , ManagerRegistry $doctrine ) : Response {
        $Reservations =  new Reservations() ;
        $form =  $this->createForm(ReservationsType::class,$Reservations) ;
        $form->add('Ajouter' , SubmitType::class) ;
        $form->handleRequest($request) ;
        if($form->isSubmitted()&& $form->isValid()){
            $Reservations = $form->getData();
            $em= $doctrine->getManager() ;
            $em->persist($Reservations);
            $em->flush();
            return $this ->redirectToRoute('add_Reservations') ;
        }
        return $this->render('reservations/frontadd.html.twig' , [
            'form' => $form->createView()
        ]) ;
    }
    #[Route('/afficher_reservations', name: 'afficher_reservations')]
    public function AfficheReservations (ReservationsRepository $repo ,PaginatorInterface $paginator ,Request $request     ): Response
    {
        //$repo=$this ->getDoctrine()->getRepository(Reservations::class) ;
        $Reservations=$repo->findAll() ;
        $pagination = $paginator->paginate(
            $Reservations,
            $request->query->getInt('page', 1),
            3 // items per page
        );
        return $this->render('reservations/index.html.twig' , [
            'Reservations' => $pagination ,
            'ajoutA' => $Reservations
        ]) ;
    }
     #[Route('/afficher_reservationsFront', name: 'afficher_reservationsFront')]
 public function AfficheReservationsFront (ReservationsRepository $repo ,PaginatorInterface $paginator ,Request $request     ): Response
    {
        //$repo=$this ->getDoctrine()->getRepository(Reservations::class) ;
        $Reservations=$repo->findAll() ;
        $pagination = $paginator->paginate(
            $Reservations,
            $request->query->getInt('page', 1),
            3 // items per page
        );
        return $this->render('reservations/indexB.html.twig' , [
            'Reservations' => $pagination ,
            'ajoutA' => $Reservations
        ]) ;
    }
    #[Route('/delete_adh/{id}', name: 'delete_adh')]
    public function Delete($id,ReservationsRepository $repository , ManagerRegistry $doctrine) : Response {
        $Reservations=$repository->find($id) ;
        $em=$doctrine->getManager() ;
        $em->remove($Reservations);
        $em->flush();
        return $this->redirectToRoute("afficher_reservations") ;

    }
    #[Route('/update_adh/{id}', name: 'update_adh')]
    function update(ReservationsRepository $repo,$id,Request $request , ManagerRegistry $doctrine){
        $Reservations = $repo->find($id) ;
        $form=$this->createForm(ReservationsType::class,$Reservations) ;
        $form->add('update' , SubmitType::class) ;
        $form->handleRequest($request) ;
        if($form->isSubmitted()&& $form->isValid()){

            $Reservations = $form->getData();
            $em=$doctrine->getManager() ;
            $em->flush();
            return $this ->redirectToRoute('afficher_reservations') ;
        }
        return $this->render('reservations/update.html.twig' , [
            'form' => $form->createView()
        ]) ;

    }
    

    

}
