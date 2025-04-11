<?php

namespace App\Repository;

use App\Entity\Dresseurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DresseursRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Dresseurs::class);
  }

  public function save(Dresseurs $entity, bool $flush = false): void
  {
    $this->_em->persist($entity);
    if ($flush) {
      $this->_em->flush();
    }
  }

  public function remove(Dresseurs $entity, bool $flush = false): void
  {
    $this->_em->remove($entity);
    if ($flush) {
      $this->_em->flush();
    }
  }

  public function findAllDresseursReduit(): array
  {
    return $this->createQueryBuilder('d')
      ->where('d.nbPokemon > 0')
      ->andWhere('d.nomDresseur != :event')
      ->setParameter('event', 'Event')
      ->getQuery()
      ->getResult();
  }

  public function findAllDresseursByRegion(int $regionId): array
  {
    return $this->createQueryBuilder('d')
      ->where('d.regionDresseur.idRegionDresseur = :region')
      ->andWhere('d.nbPokemon > 0')
      ->setParameter('region', $regionId)
      ->getQuery()
      ->getResult();
  }

  public function findDresseursByRegionAndPart(int $regionId, int $minId, int $maxId): array
  {
    return $this->createQueryBuilder('d')
      ->where('d.regionDresseur.idRegionDresseur = :region')
      ->andWhere('d.id BETWEEN :minId AND :maxId')
      ->andWhere('d.nbPokemon > 0')
      ->setParameters([
        'region' => $regionId,
        'minId' => $minId,
        'maxId' => $maxId,
      ])
      ->getQuery()
      ->getResult();
  }

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
