<?php

namespace App\Repository;

use App\Entity\Perguntas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Perguntas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Perguntas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Perguntas[]    findAll()
 * @method Perguntas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerguntasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Perguntas::class);
    }

    // /**
    //  * @return Perguntas[] Returns an array of Perguntas objects
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
    public function findOneBySomeField($value): ?Perguntas
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
