<?php

namespace App\Repository;

use App\Entity\Pergunta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pergunta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pergunta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pergunta[]    findAll()
 * @method Pergunta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerguntasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pergunta::class);
    }

     /**
      * @return Pergunta[] Returns an array of Pergunta objects
      */
    public function getPerguntasRespostas($userId)
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.respostas','r','WITH')
            ->where('p.usuario = :userid')
            ->setParameter('userid', $userId)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Pergunta
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
