<?php

namespace App\Repository;

use App\Entity\PokedexNational;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PokedexNationalRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, PokedexNational::class);
  }

  /**
   * Trouver tous les Pokémon avec leurs relations
   * @return PokedexNational[]
   */
  public function findAllPokemonsWithRelations(): array
  {
    return $this->createQueryBuilder('p')
      ->leftJoin('p.naturePokedex', 'n')->addSelect('n')
      ->leftJoin('p.pokeballPokedex', 'pb')->addSelect('pb')
      ->leftJoin('p.boitePokedex', 'b')->addSelect('b')
      ->leftJoin('p.dresseurPokedex', 'd')->addSelect('d')
      ->getQuery()
      ->getResult();
  }

  /**
   * Récupérer les Pokémon d’une région donnée
   * @param int $regionId
   * @return PokedexNational[]
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
   * Pokémon d'une région (version admin avec toutes les relations)
   * @param int $regionId
   * @return PokedexNational[]
   */
  public function findPokemonsByRegionForAdmin(int $regionId): array
  {
    return $this->createQueryBuilder('p')
      ->leftJoin('p.naturePokedex', 'n')->addSelect('n')
      ->leftJoin('p.dresseurPokedex', 'd')->addSelect('d')
      ->leftJoin('p.pokeballPokedex', 'pb')->addSelect('pb')
      ->leftJoin('p.boitePokedex', 'b')->addSelect('b')
      ->leftJoin('p.region', 'r')->addSelect('r')
      ->where('r.idRegion = :regionId')
      ->setParameter('regionId', $regionId)
      ->getQuery()
      ->getResult();
  }

  /**
   * Compter tous les Pokémon dans le Pokédex
   * @return int
   */
  public function countPokemonsInPokedex(): int
  {
    return (int) $this->createQueryBuilder('p')
      ->select('COUNT(p.id)')
      ->getQuery()
      ->getSingleScalarResult();
  }

  /**
   * Compter les Pokémon par région
   * @return array
   */
  public function countPokemonsByRegion(): array
  {
    return $this->createQueryBuilder('p')
      ->select('r.nomRegion, COUNT(p.id) AS nb')
      ->leftJoin('p.region', 'r')
      ->groupBy('r.nomRegion')
      ->getQuery()
      ->getResult();
  }
}
