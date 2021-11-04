<?php

namespace App\Repository;

use App\Entity\Respostas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Respostas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Respostas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Respostas[]    findAll()
 * @method Respostas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RespostasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Respostas::class);
    }

    // /**
    //  * @return Respostas[] Returns an array of Respostas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Respostas
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
