<?php

namespace App\Repository;

use App\Entity\BoitesShiny;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BoitesShinyRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
      parent::__construct($registry, BoitesShiny::class);
  }

  // Trouver une boîte par son nom
  public function findByNom(string $nom): ?BoitesShiny
  {
    return $this->createQueryBuilder('b')
      ->andWhere('b.nom = :nom')
      ->setParameter('nom', $nom)
      ->getQuery()
      ->getOneOrNullResult();
  }

  // Compter le nombre total de boîtes shiny
  public function countBoitesShiny(): int
  {
    return $this->createQueryBuilder('b')
      ->select('COUNT(b)')
      ->getQuery()
      ->getSingleScalarResult();
  }

  // Stats globales par Pokeball
  public function allStatsByPokeball(): array
  {
    return $this->getEntityManager()->createQuery(
      "SELECT p.nomPokeball AS pokeball, p.nbShiny
      FROM App\Entity\Pokeballs p
      WHERE p.nbShiny > 0 AND p.nbShiny IS NOT NULL
      ORDER BY p.nbShiny DESC"
    )->getResult();
  }

  // Stats globales par dresseur
  public function allStatsByDresseur(): array
  {
    return $this->getEntityManager()->createQuery(
      "SELECT
        CASE WHEN d.nomDresseur = 'event' THEN 'event' ELSE d.nomDresseur END AS dresseur,
        SUM(bd.nbPokemon) AS nbPokemon,
        CASE WHEN d.nomDresseur = 'event' THEN 'event' ELSE d.numDresseur END AS numDresseur
      FROM App\Entity\BoiteDresseur bd
      JOIN bd.dresseur d
      GROUP BY dresseur, numDresseur
      ORDER BY numDresseur, dresseur"
    )->getResult();
  }

  // Stats globales par sexe
  public function allStatsByGenre(): array
  {
    return $this->createQueryBuilder('g')
      ->select('g.genre AS genre, g.nbShiny')
      ->where('g.nbShiny > 0')
      ->andWhere('g.nbShiny IS NOT NULL')
      ->orderBy('g.nbShiny', 'DESC')
      ->getQuery()
      ->getResult();
  }

  // Stats globales par nature
  public function allStatsByNature(): array
  {
    return $this->getEntityManager()->createQuery(
      "SELECT n.nomNature AS nature, n.nbShiny
      FROM App\Entity\Natures n
      WHERE n.nbShiny > 0 AND n.nbShiny IS NOT NULL
      ORDER BY n.nbShiny DESC"
    )->getResult();
  }

  // Stats globales par type
  public function allStatsByType(): array
  {
    return $this->getEntityManager()->createQuery(
      "SELECT t.nomType AS type, t.nbShiny FROM App\Entity\Types t"
    )->getResult();
  }

  // Stats d'une boîte spécifique par Pokeball
  public function statsByBoitePokeball(int $boiteId): array
  {
    return $this->getEntityManager()->createQuery(
      "SELECT p.nomPokeball AS pokeball, bp.nbPokemon
      FROM App\Entity\BoitePokeball bp
      JOIN bp.pokeball p
      WHERE bp.boite = :boiteId"
    )->setParameter('boiteId', $boiteId)
    ->getResult();
  }

  // Stats d'une boîte spécifique par Dresseur
  public function statsByBoiteDresseur(int $boiteId): array
  {
    return $this->getEntityManager()->createQuery(
      "SELECT
        CASE WHEN d.nomDresseur = 'Event' THEN 'Event' ELSE d.nomDresseur END AS dresseur,
        SUM(bd.nbPokemon) AS nbPokemon,
        CASE WHEN d.nomDresseur = 'Event' THEN 'Event' ELSE d.numDresseur END AS numDresseur,
        MAX(CASE WHEN d.nomDresseur = 'Event' THEN NULL ELSE d.id END) AS idDresseur
      FROM App\Entity\BoiteDresseur bd
      JOIN bd.dresseur d
      WHERE bd.boite = :boiteId
      GROUP BY dresseur, numDresseur
      ORDER BY numDresseur, dresseur"
    )->setParameter('boiteId', $boiteId)
    ->getResult();
  }

  // Stats d'une boîte spécifique par Genre
  public function statsByBoiteGenre(int $boiteId): array
  {
    return $this->createQueryBuilder('bg')
      ->select('g.genre AS genre, bg.nbPokemon')
      ->join('bg.genre', 'g')
      ->where('bg.boite = :boiteId')
      ->setParameter('boiteId', $boiteId)
      ->getQuery()
      ->getResult();
  }

  // Stats d'une boîte spécifique par Nature
  public function statsByBoiteNature(int $boiteId): array
  {
    return $this->getEntityManager()->createQuery(
      "SELECT n.nomNature AS nature, bn.nbPokemon
      FROM App\Entity\BoiteNature bn
      JOIN bn.nature n
      WHERE bn.boite = :boiteId"
    )->setParameter('boiteId', $boiteId)
    ->getResult();
  }

  // Stats d'une boîte spécifique par Type
  public function statsByBoiteType(int $boiteId): array
  {
    return $this->getEntityManager()->createQuery(
      "SELECT t.nomType AS type, bt.nbPokemon
      FROM App\Entity\BoiteType bt
      JOIN bt.type t
      WHERE bt.boite = :boiteId"
    )->setParameter('boiteId', $boiteId)
    ->getResult();
  }
}
