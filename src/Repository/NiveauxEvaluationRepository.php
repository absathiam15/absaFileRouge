<?php

namespace App\Repository;

use App\Entity\NiveauxEvaluation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NiveauxEvaluation|null find($id, $lockMode = null, $lockVersion = null)
 * @method NiveauxEvaluation|null findOneBy(array $criteria, array $orderBy = null)
 * @method NiveauxEvaluation[]    findAll()
 * @method NiveauxEvaluation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NiveauxEvaluationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NiveauxEvaluation::class);
    }

    // /**
    //  * @return NiveauxEvaluation[] Returns an array of NiveauxEvaluation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NiveauxEvaluation
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
