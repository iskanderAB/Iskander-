<?php

namespace App\Repository;

use App\Entity\Pai;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Pai|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pai|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pai[]    findAll()
 * @method Pai[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pai::class);
    }

    // /**
    //  * @return Pai[] Returns an array of Pai objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pai
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
