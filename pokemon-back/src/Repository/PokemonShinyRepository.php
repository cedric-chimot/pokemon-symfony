<?php

namespace App\Repository;

use App\Entity\PokemonShiny;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<PokemonShiny>
 */
class PokemonShinyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PokemonShiny::class);
    }

    /**
     * Requête pour afficher un Pokémon selon son numéro de Pokédex
     */
    public function findByNumDex(string $numDex): array
    {
        return $this->createQueryBuilder('p')
            ->select('p.id, p.numDex, p.nomPokemon')
            ->where('p.numDex = :numDex')
            ->setParameter('numDex', $numDex)
            ->getQuery()
            ->getResult();
    }

    /**
     * Requête pour ordonner une liste de shiny dans une boîte selon l'id de la boîte
     */
    public function findByBoitePosition(int $idBoite): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.boite = :idBoite')
            ->setParameter('idBoite', $idBoite)
            ->orderBy('p.position', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Requête pour comptabiliser le nombre de shiny par IVs manquants
     */
    public function getStatsIvManquant(): array
    {
        return $this->createQueryBuilder('p')
            ->select('p.ivManquant AS ivManquant, COUNT(p) AS count')
            ->groupBy('p.ivManquant')
            ->orderBy('p.ivManquant', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Requête pour afficher tous les shiny par région
     */
    public function findByRegion(int $idRegion): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.regionShiny = :idRegion')
            ->setParameter('idRegion', $idRegion)
            ->getQuery()
            ->getResult();
    }

    /**
     * Requête pour compter le nombre total de Pokémon shiny
     */
    public function countPokemonsShiny(): int
    {
        return $this->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
