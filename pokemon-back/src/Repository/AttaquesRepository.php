<?php

namespace App\Repository;

use App\Entity\Attaques;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Attaques>
 */
class AttaquesRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Attaques::class);
  }

  /**
   * Récupère toutes les attaques triées par nomAttaque
   * @return Attaques[]
   */
  public function findAllSortedByNom(): array
  {
    return $this->createQueryBuilder('a')
      ->orderBy('a.nomAttaque', 'ASC')
      ->getQuery()
      ->getResult();
  }

  /**
   * Compte le nombre total d'attaques
   * @return int
   */
  public function countAttaques(): int
  {
    return (int) $this->createQueryBuilder('a')
      ->select('COUNT(a.id)')
      ->getQuery()
      ->getSingleScalarResult();
  }

  /**
   * Récupère les attaques d'un type spécifique
   * @param int $typeId
   * @return Attaques[]
   */
  public function findByType(int $typeId): array
  {
    return $this->createQueryBuilder('a')
      ->andWhere('a.typeAttaque = :typeId')
      ->setParameter('typeId', $typeId)
      ->getQuery()
      ->getResult();
  }

  /**
   * Retourne le nombre d'attaques par type
   * @return array
   */
  public function countAttaquesByType(): array
  {
    return $this->createQueryBuilder('a')
      ->select('t.nomType, COUNT(a.id) AS nombre')
      ->join('a.typeAttaque', 't')
      ->groupBy('t.nomType')
      ->getQuery()
      ->getResult();
  }
}
