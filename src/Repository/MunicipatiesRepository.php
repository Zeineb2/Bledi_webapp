<?php

namespace App\Repository;

use App\Entity\Municipaties;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Municipaties>
 *
 * @method Municipaties|null find($id, $lockMode = null, $lockVersion = null)
 * @method Municipaties|null findOneBy(array $criteria, array $orderBy = null)
 * @method Municipaties[]    findAll()
 * @method Municipaties[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MunicipatiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Municipaties::class);
    }

//    /**
//     * @return Municipaties[] Returns an array of Municipaties objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Municipaties
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
