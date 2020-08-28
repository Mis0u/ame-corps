<?php

namespace App\Repository;

use App\Entity\Sensitiv\WellDone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WellDone|null find($id, $lockMode = null, $lockVersion = null)
 * @method WellDone|null findOneBy(array $criteria, array $orderBy = null)
 * @method WellDone[]    findAll()
 * @method WellDone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WellDoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WellDone::class);
    }

    // /**
    //  * @return WellDone[] Returns an array of WellDone objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WellDone
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
