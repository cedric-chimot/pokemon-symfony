<?php

namespace App\Repository;

use App\Entity\BoiteShinyPokeball;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BoiteShinyPokeball>
 */
class BoiteShinyPokeballRepository extends ServiceEntityRepository
{
  public function findByBoiteAndPokeball($boite, $pokeball): ?BoiteShinyPokeball
  {
      return $this->createQueryBuilder('bp')
          ->andWhere('bp.boite = :boite')
          ->andWhere('bp.pokeball = :pokeball')
          ->setParameter('boite', $boite)
          ->setParameter('pokeball', $pokeball)
          ->getQuery()
          ->getOneOrNullResult();
  }
  
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, BoiteShinyPokeball::class);
  }

  public function add(BoiteShinyPokeball $entity, bool $flush = false): void
  {
    $this->_em->persist($entity);

    if ($flush) {
      $this->_em->flush();
    }
  }

  public function remove(BoiteShinyPokeball $entity, bool $flush = false): void
  {
    $this->_em->remove($entity);

    if ($flush) {
      $this->_em->flush();
    }
  }
}
