<?php

namespace App\Repository;

use App\Entity\Natures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Natures>
 */
class NaturesRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Natures::class);
  }

  //    /**
  //     * @return Natures[] Returns an array of Natures objects
  //     */
  //    public function findByExampleField($value): array
  //    {
  //        return $this->createQueryBuilder('n')
  //            ->andWhere('n.exampleField = :val')
  //            ->setParameter('val', $value)
  //            ->orderBy('n.id', 'ASC')
  //            ->setMaxResults(10)
  //            ->getQuery()
  //            ->getResult()
  //        ;
  //    }

  //    public function findOneBySomeField($value): ?Natures
  //    {
  //        return $this->createQueryBuilder('n')
  //            ->andWhere('n.exampleField = :val')
  //            ->setParameter('val', $value)
  //            ->getQuery()
  //            ->getOneOrNullResult()
  //        ;
  //    }
}
