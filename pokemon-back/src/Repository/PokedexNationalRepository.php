<?php

namespace App\Repository;

use App\Entity\PokedexNational;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

class PokedexNationalRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, PokedexNational::class);
  }

  /**
   * Récupère tous les pokémons avec leurs relations (JOIN FETCH en Java)
   */
  public function findAllPokemonsWithRelations(): array
  {
    return $this->createQueryBuilder('p')
      ->addSelect('n', 'pb', 'b', 'd')
      ->join('p.nature', 'n')
      ->join('p.pokeball', 'pb')
      ->join('p.boitePokedex', 'b')
      ->join('p.dresseur', 'd')
      ->getQuery()
      ->getResult();
  }

  /**
   * Récupère les pokémons par région
   */
  public function findByRegion(int $regionId): array
  {
    return $this->createQueryBuilder('p')
      ->where('p.region = :regionId')
      ->setParameter('regionId', $regionId)
      ->getQuery()
      ->getResult();
  }

  /**
   * Récupère les pokémons par région avec toutes les relations (pour admin)
   */
  public function findPokemonsByRegionForAdmin(int $regionId): array
  {
    return $this->createQueryBuilder('p')
      ->addSelect('n', 'pb', 'b', 'd', 'r')
      ->join('p.nature', 'n')
      ->join('p.pokeball', 'pb')
      ->join('p.boitePokedex', 'b')
      ->join('p.dresseur', 'd')
      ->join('p.region', 'r')
      ->where('r.id = :regionId')
      ->setParameter('regionId', $regionId)
      ->getQuery()
      ->getResult();
  }

  /**
   * Compte le nombre de pokémons total dans le Pokédex
   */
  public function countPokemonsInPokedex(): int
  {
    return $this->createQueryBuilder('p')
      ->select('COUNT(p.id)')
      ->getQuery()
      ->getSingleScalarResult();
  }

  /**
   * Nombre de pokémons par région (groupé)
   */
  public function countPokemonsByRegion(): array
  {
    return $this->createQueryBuilder('p')
      ->select('r.nomRegion AS region', 'COUNT(p.id) AS total')
      ->join('p.region', 'r')
      ->groupBy('r.nomRegion')
      ->getQuery()
      ->getResult();
  }
}
