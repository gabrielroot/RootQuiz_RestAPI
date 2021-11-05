<?php

namespace App\Repository;

use App\Entity\Resposta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Resposta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resposta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resposta[]    findAll()
 * @method Resposta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RespostasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resposta::class);
    }

    // /**
    //  * @return Resposta[] Returns an array of Resposta objects
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
    public function findOneBySomeField($value): ?Resposta
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
