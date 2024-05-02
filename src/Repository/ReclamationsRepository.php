<?php

namespace App\Repository;

use App\Entity\Reclamations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Twilio\Rest\Client;
/**
 * @extends ServiceEntityRepository<Reclamations>
 *
 * @method Reclamations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reclamations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reclamations[]    findAll()
 * @method Reclamations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReclamationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reclamations::class);
    }

//    /**
//     * @return Reclamations[] Returns an array of Reclamations objects
//     */
public function findByPriority(): array
{
    return $this->createQueryBuilder('r')
        ->join('r.categorie', 'c') // Joindre la table de catégorie
        ->orderBy('c.priority', 'DESC') // Utiliser le chemin d'association correct
        ->getQuery()
        ->getResult();
}


public  function sms()
    {
        // Your Account SID and Auth Token from twilio.com/console
        $sid = 'ACd413fa5da762264fe3ccf77c9d7ce56d';
        $auth_token = '145b21b22ec32ebf2b6d69e62ff372fb';
        // In production, these should be environment variables. E.g.:
        // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]
        // A Twilio number you own with SMS capabilities
        $twilio_number = "+12626078033";

        $client = new Client($sid, $auth_token);
        $client->messages->create(
            // the number you'd like to send the message to
            '+21629250170',
            [
                // A Twilio phone number you purchased at twilio.com/console
                'from' => '+12626078033',
                // the body of the text message you'd like to send
                'body' => 'votre ajouter une reclamation'
            ]
        );
    }

//    public function findOneBySomeField($value): ?Reclamations
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
