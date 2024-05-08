<?php

namespace App\Repository;

use App\Entity\CompagneDons;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompagneDons>
 *
 * @method CompagneDons|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompagneDons|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompagneDons[]    findAll()
 * @method CompagneDons[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompagneDonsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        
        parent::__construct($registry, CompagneDons::class);
    }
     /**
     * @return CompagneDons[] Returns an array of CompagneDons objects with total amount of donations
     */ 

     public function findAllWithTotalAmount()
     {
         $result = $this->createQueryBuilder('c')
             ->select('c', 'SUM(d.montant_don) AS totalAmount')
             ->leftJoin('c.dons', 'd')
             ->groupBy('c.id')
             ->getQuery()
             ->getResult();
     
         // Calculate totalAmount by summing the montant_don of each donation
         foreach ($result as $row) {
             // Extract the CompagneDons entity and totalAmount from the result row
             /** @var CompagneDons $compagne */
             $compagne = $row[0];
             $totalAmount = $row['totalAmount'];
     
             // Calculate totalAmount by summing the montant_don of each donation associated with the campaign
             foreach ($compagne->getDons() as $don) {
                 $totalAmount += $don->getMontantDon();
             }
     
             // Set the calculated totalAmount to the result row
             $row['totalAmount'] = $totalAmount;
         }
     
         return $result;
     }
     
     
    public function findByFullTextSearch($searchTerm):array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.descrip LIKE :searchTerm ')
            ->setParameter('searchTerm', '%' . $searchTerm . '%')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return CompagneDons[] Returns an array of CompagneDons objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CompagneDons
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
