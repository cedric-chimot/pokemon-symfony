<?php

namespace App\Repository;

use App\Entity\Dresseurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Dresseurs>
 */
class DresseursRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Dresseurs::class);
  }

  //    /**
  //     * @return Dresseurs[] Returns an array of Dresseurs objects
  //     */
  //    public function findByExampleField($value): array
  //    {
  //        return $this->createQueryBuilder('d')
  //            ->andWhere('d.exampleField = :val')
  //            ->setParameter('val', $value)
  //            ->orderBy('d.id', 'ASC')
  //            ->setMaxResults(10)
  //            ->getQuery()
  //            ->getResult()
  //        ;
  //    }

  //    public function findOneBySomeField($value): ?Dresseurs
  //    {
  //        return $this->createQueryBuilder('d')
  //            ->andWhere('d.exampleField = :val')
  //            ->setParameter('val', $value)
  //            ->getQuery()
  //            ->getOneOrNullResult()
  //        ;
  //    }
}
