<?php

namespace App\Repository;

use App\Entity\Ethic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ethic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ethic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ethic[]    findAll()
 * @method Ethic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EthicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ethic::class);
    }

    // /**
    //  * @return Ethic[] Returns an array of Ethic objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ethic
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
