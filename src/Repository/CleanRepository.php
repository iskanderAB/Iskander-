<?php

namespace App\Repository;

use App\Entity\Clean;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Clean|null find($id, $lockMode = null, $lockVersion = null)
 * @method Clean|null findOneBy(array $criteria, array $orderBy = null)
 * @method Clean[]    findAll()
 * @method Clean[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CleanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Clean::class);
    }

    // /**
    //  * @return Clean[] Returns an array of Clean objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Clean
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
