<?php

namespace App\Repository;

use App\Entity\BoiteShinyType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BoiteShinyType>
 */
class BoiteShinyTypeRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, BoiteShinyType::class);
  }

  //    /**
  //     * @return BoiteShinyType[] Returns an array of BoiteShinyType objects
  //     */
  //    public function findByExampleField($value): array
  //    {
  //        return $this->createQueryBuilder('b')
  //            ->andWhere('b.exampleField = :val')
  //            ->setParameter('val', $value)
  //            ->orderBy('b.id', 'ASC')
  //            ->setMaxResults(10)
  //            ->getQuery()
  //            ->getResult()
  //        ;
  //    }

  //    public function findOneBySomeField($value): ?BoiteShinyType
  //    {
  //        return $this->createQueryBuilder('b')
  //            ->andWhere('b.exampleField = :val')
  //            ->setParameter('val', $value)
  //            ->getQuery()
  //            ->getOneOrNullResult()
  //        ;
  //    }
}
