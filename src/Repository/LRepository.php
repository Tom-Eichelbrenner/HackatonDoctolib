<?php

namespace App\Repository;

use App\Entity\L;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method L|null find($id, $lockMode = null, $lockVersion = null)
 * @method L|null findOneBy(array $criteria, array $orderBy = null)
 * @method L[]    findAll()
 * @method L[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, L::class);
    }

    // /**
    //  * @return L[] Returns an array of L objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?L
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
