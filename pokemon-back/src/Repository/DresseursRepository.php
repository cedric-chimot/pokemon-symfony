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

  /**
   * Dresseurs avec nbPokemon > 0 et nom != 'Event'
   * @return Dresseurs[]
   */
  public function findAllDresseursReduit(): array
  {
    return $this->createQueryBuilder('d')
      ->where('d.nbPokemon > 0')
      ->andWhere('d.nomDresseur != :event')
      ->setParameter('event', 'Event')
      ->getQuery()
      ->getResult();
  }

  /**
   * Dresseurs de la région 1 (non découpés)
   * @return Dresseurs[]
   */
  public function findAllDresseursByRegion1(): array
  {
    return $this->createQueryBuilder('d')
      ->where('d.regionDresseur IS NOT NULL')
      ->andWhere('d.regionDresseur.idRegionDresseur = 1')
      ->andWhere('d.nbPokemon > 0')
      ->getQuery()
      ->getResult();
  }

  /**
   * Dresseurs région 1 - Partie 1 (id 1 à 40)
   * @return Dresseurs[]
   */
  public function findAllDresseursByRegion1Part1(): array
  {
    return $this->createQueryBuilder('d')
      ->where('d.regionDresseur.idRegionDresseur = 1')
      ->andWhere('d.id BETWEEN 1 AND 40')
      ->andWhere('d.nbPokemon > 0')
      ->getQuery()
      ->getResult();
  }

  /**
   * Dresseurs région 1 - Partie 2 (id 41 à 81)
   * @return Dresseurs[]
   */
  public function findAllDresseursByRegion1Part2(): array
  {
    return $this->createQueryBuilder('d')
      ->where('d.regionDresseur.idRegionDresseur = 1')
      ->andWhere('d.id BETWEEN 41 AND 81')
      ->andWhere('d.nbPokemon > 0')
      ->getQuery()
      ->getResult();
  }

  /**
   * Dresseurs de la région 2
   * @return Dresseurs[]
   */
  public function findAllDresseursRegion2(): array
  {
    return $this->createQueryBuilder('d')
      ->where('d.regionDresseur.idRegionDresseur = 2')
      ->andWhere('d.regionDresseur IS NOT NULL')
      ->andWhere('d.nbPokemon > 0')
      ->getQuery()
      ->getResult();
  }

  /**
   * Dresseurs de la région 3
   * @return Dresseurs[]
   */
  public function findAllDresseursRegion3(): array
  {
    return $this->createQueryBuilder('d')
      ->where('d.regionDresseur.idRegionDresseur = 3')
      ->andWhere('d.regionDresseur IS NOT NULL')
      ->andWhere('d.nbPokemon > 0')
      ->getQuery()
      ->getResult();
  }

  /**
   * Compter les dresseurs (hors id 119 à 140, et nbPokemon > 0)
   * @return int
   */
  public function countDresseurs(): int
  {
    return (int) $this->createQueryBuilder('d')
      ->select('COUNT(d.id)')
      ->where('(d.id < 119 OR d.id > 140)')
      ->andWhere('d.nbPokemon > 0')
      ->getQuery()
      ->getSingleScalarResult();
  }
}
