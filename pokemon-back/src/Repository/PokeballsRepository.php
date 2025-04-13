<?php

namespace App\Repository;

use App\Entity\Pokeballs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pokeballs>
 */
class PokeballsRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Pokeballs::class);
  }

  /**
   * Retourne la liste des pokeballs contenant au moins un Pokémon
   *
   * @return Pokeballs[]
   */
  public function findAllPokeballs(): array
  {
    return $this->createQueryBuilder('p')
      ->where('p.nbPokemon > 0')
      ->getQuery()
      ->getResult();
  }
}
