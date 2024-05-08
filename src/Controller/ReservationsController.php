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
use App\Entity\Reclamation;
use App\Entity\Reponse;
use App\Form\ReclamationType;
use App\Form\ReponseType;
use App\Repository\ReclamationRepository;

use Symfony\Component\String\Slugger\SluggerInterface;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Snipe\BanBuilder\CensorWords;
use Dompdf\Dompdf;
use Dompdf\Options;
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
         $censor = new CensorWords;// censor
    $langs = array('fr', 'it', 'en-us', 'en-uk', 'es');
    $badwords = $censor->setDictionary($langs);
    $censor->setReplaceChar("*");
        if($form->isSubmitted()&& $form->isValid()){

            $Reservations = $form->getData();
$string = $censor->censorString($Reservations->getCommentaire());
        $Reservations->setCommentaire($string['clean']);

            $em= $doctrine->getManager() ;
            $em->persist($Reservations);
            $em->flush();
            return $this ->redirectToRoute('afficher_reservations') ;
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
    
#[Route('/like/{id}', name: 'like_reservations')]
public function likeQuestion($id, ReservationsRepository $ReservationsRepository, ManagerRegistry $doctrine): Response
{
    $Reservations = $ReservationsRepository->find($id);

    if (!$Reservations) {
        throw $this->createNotFoundException('Question not found');
    }

    // Increment the likes count
    $Reservations->like();

    // Get the entity manager from the registry
    $entityManager = $doctrine->getManager();

    // Persist the changes to the database
    $entityManager->persist($Reservations);
    $entityManager->flush();

    return $this->redirectToRoute('afficher_reservationsFront');
}

#[Route('/dislike/{id}', name: 'dislike_reservations')]
public function dislikeQuestion($id, ReservationsRepository $ReservationsRepository, ManagerRegistry $doctrine): Response
{
    $Reservations = $ReservationsRepository->find($id);

    if (!$Reservations) {
        throw $this->createNotFoundException('Question not found');
    }

    // Increment the dislikes count
    $Reservations->dislike();

    // Get the entity manager from the registry
    $entityManager = $doctrine->getManager();

    // Persist the changes to the database
    $entityManager->persist($Reservations);
    $entityManager->flush();

    return $this->redirectToRoute('afficher_reservationsFront');
}
    
#[Route('/rate/{id}', name: 'rate_reservations')]
public function rateReservations($id, Request $request, ReservationsRepository $reservationsRepository, ManagerRegistry $doctrine): Response
{
    $reservations = $reservationsRepository->find($id);

    if (!$reservations) {
        throw $this->createNotFoundException('Réponse non trouvée');
    }

    $rating = $request->request->get('rating'); // Suppose que le rating est envoyé via POST, ajustez si nécessaire

    // Assurez-vous que le rating est valide (entre 1 et 5)
    if ($rating < 1 || $rating > 5) {
        throw new \InvalidArgumentException('Le rating doit être un nombre entre 1 et 5');
    }

    // Mettez à jour le rating de la réponse
    $reservations->setRating($rating);

    // Obtenez l'entityManager à partir du registre
    $entityManager = $doctrine->getManager();

    // Persistez les modifications dans la base de données
    $entityManager->persist($reservations);
    $entityManager->flush();

    // Redirigez vers la page précédente ou une autre page si nécessaire
    return $this->redirectToRoute('afficher_reservationsFront');
}

}
