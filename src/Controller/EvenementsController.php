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
use Symfony\Component\Security\Core\Security;

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
            if($brochureFile->getClientOriginalName() == null){
                return $this->render('evenements/addevenementss.html.twig' , [
                    'form' => $form->createView()
                ]) ;
            }
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

            return $this ->redirectToRoute('app_evenements') ;
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
    
public function reserver(Request  $request , ManagerRegistry $doctrine, Security $security): Response
 {
    $Reservations =  new Reservations();
    $Reservations->setEvenementss($doctrine->getRepository(Evenements::class)->find($request->get('id')));
    $user = $security->getUser();
    if (method_exists($user, 'getCin')) {
        $Reservations->setCINCit($user->getCin());
    }
    $form =  $this->createForm(ReservationsType::class, $Reservations);
    $form->add('Ajouter', SubmitType::class);
    $form->handleRequest($request);
    $censor = new CensorWords; // censor
    $langs = array('fr', 'it', 'en-us', 'en-uk', 'es');
    $badwords = $censor->setDictionary($langs);
    $censor->setReplaceChar("*");
    if ($form->isSubmitted() && $form->isValid()) {
        $Reservations = $form->getData();
        $string = $censor->censorString($Reservations->getCommentaire());
        $Reservations->setCommentaire($string['clean']);

        $em = $doctrine->getManager();
        $em->persist($Reservations);
        $em->flush();

        return $this->redirectToRoute('add_Reservations');
    }

    return $this->render('reservations/frontadd.html.twig', [
        'form' => $form->createView()
    ]);
 }
 

 #[Route('/generate_pdf', name: 'generate_pdf')]
public function generatePdfAction(EvenementsRepository $repo, PaginatorInterface $paginator, Request $request): Response
{
    // Récupérer les réclamations avec pagination
    $searchTerm = $request->query->get('search');
    $evenementss = $repo->searchByTypeOrNameOrComment($searchTerm);
    $pagination = $paginator->paginate(
        $evenementss,
        $request->query->getInt('page', 1),
        4 // items per page
    );

    // Rendre le contenu HTML à partir du modèle Twig
    $html = $this->renderView('evenements/pdf_evenementss.html.twig', [
        'Evenements' => $evenementss,
    ]);

    // Créer une instance de Dompdf avec les options de configuration
    $options = new Options();
    $options->set('isPhpEnabled', true); // Activer l'exécution de PHP dans le contenu HTML
    $dompdf = new Dompdf($options);

    // Charger le contenu HTML dans Dompdf
    $dompdf->loadHtml($html);

    // (Optionnel) Définir les options de rendu de Dompdf, par exemple la taille du papier, l'orientation, etc.

    // Rendre le PDF
    $dompdf->render();

    // Renvoyer la réponse avec le PDF en tant que contenu
    return new Response(
        $dompdf->output(),
        Response::HTTP_OK,
        [
            'Content-Type' => 'application/pdf',
        ]
    );


}

 #[Route('/statsrec', name: 'statsrec')]
public function statistiques(EvenementsRepository $recrepo): Response
    {
        // Mapper chaque type de évènement à sa couleur spécifique
        $typeColors = [
            'ecologique' => '#ff0000', // Rouge
            'atelier' => '#00ff00', // Vert
            'culturel' => '#0000ff',    // Bleu
            'dd' => '#ffff00', // Jaune
        ];

        // Récupérer toutes les évents
        $rec = $recrepo->findAll();

        // Initialiser des tableaux pour stocker les données
        $recColor = [];
        $recCount = [];

        // Compter le nombre de events pour chaque couleur
        foreach ($rec as $evenements) {
            $color = $typeColors[$evenements->getCategorieEvenet()];

            // Si la couleur n'est pas déjà présente dans le tableau, l'ajouter
            if (!isset($recColor[$color])) {
                $recColor[$color] = $color;
                $recCount[$color] = 0;
            }

            // Incrémenter le nombre de events pour cette couleur
            $recCount[$color]++;
        }

        // Convertir les données en format JSON pour le modèle Twig
        $recColor = array_values($recColor); // Réordonner les clés du tableau
        $recCount = array_values($recCount);

        // Rendre la vue Twig avec les données des statistiques
        return $this->render('stat/stats.html.twig', [
            'recColor' => json_encode($recColor),
            'recCount' => json_encode($recCount),
        ]);
    }
   #[Route('/calendrier', name: 'calendrier')]
    public function calendrier(EvenementsRepository $evenementsRepository): Response
    {
        $evenements = $evenementsRepository->findAll();

        $formattedEvents = [];
        foreach ($evenements as $evenement) {
            $formattedEvents[] = [
                'title' => $evenement->getNomEvent(),
                'start' => $evenement->getDateD()->format('Y-m-d'),
                'end' => $evenement->getDateF()->format('Y-m-d'),
            ];
        }

        return $this->render('evenements/calendrier.html.twig', [
            'evenements' => json_encode($formattedEvents),
        ]);
    }

}


