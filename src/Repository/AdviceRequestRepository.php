<?php

namespace App\Repository;

use App\Entity\AdviceRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdviceRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdviceRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdviceRequest[]    findAll()
 * @method AdviceRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdviceRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdviceRequest::class);
    }

    // /**
    //  * @return AdviceRequest[] Returns an array of AdviceRequest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AdviceRequest
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
