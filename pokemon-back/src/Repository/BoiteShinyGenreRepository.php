<?php

namespace App\Repository;

use App\Entity\BoiteShinyGenre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BoiteShinyGenre>
 */
class BoiteShinyGenreRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, BoiteShinyGenre::class);
  }

  //    /**
  //     * @return BoiteShinyGenre[] Returns an array of BoiteShinyGenre objects
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

  //    public function findOneBySomeField($value): ?BoiteShinyGenre
  //    {
  //        return $this->createQueryBuilder('b')
  //            ->andWhere('b.exampleField = :val')
  //            ->setParameter('val', $value)
  //            ->getQuery()
  //            ->getOneOrNullResult()
  //        ;
  //    }
}
