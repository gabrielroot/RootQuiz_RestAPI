<?php

namespace App\Repository;

use App\Entity\Tentativa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tentativa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tentativa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tentativa[]    findAll()
 * @method Tentativa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TentativasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tentativa::class);
    }

    // /**
    //  * @return Tentativa[] Returns an array of Tentativa objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tentativa
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
