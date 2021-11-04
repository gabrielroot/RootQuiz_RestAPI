<?php

namespace App\Repository;

use App\Entity\Tentativas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tentativas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tentativas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tentativas[]    findAll()
 * @method Tentativas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TentativasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tentativas::class);
    }

    // /**
    //  * @return Tentativas[] Returns an array of Tentativas objects
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
    public function findOneBySomeField($value): ?Tentativas
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
