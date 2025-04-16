<?php

namespace App\Repository;

use App\Entity\BoiteShinyDresseur;
use App\Entity\Boites;
use App\Entity\Dresseurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BoiteShinyDresseur>
 */
class BoiteShinyDresseurRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, BoiteShinyDresseur::class);
  }

  /**
   * Permet de trouver une association unique entre une boîte et un dresseur
   */
  public function findByBoiteAndDresseur(Boites $boite, Dresseurs $dresseur): ?BoiteShinyDresseur
  {
    return $this->createQueryBuilder('b')
      ->andWhere('b.boiteShiny = :boite') // <-- ici
      ->andWhere('b.dresseur = :dresseur')
      ->setParameter('boite', $boite)
      ->setParameter('dresseur', $dresseur)
      ->getQuery()
      ->getOneOrNullResult();
  }

}
