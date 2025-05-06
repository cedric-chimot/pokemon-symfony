<?php

namespace App\Repository;

use App\Entity\BoiteShinyGenre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BoiteShinyGenre>
 */
class BoiteShinyGenreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BoiteShinyGenre::class);
    }

    public function findByBoiteAndGenre($boite, $genre): ?BoiteShinyGenre
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.boite = :boite')
            ->andWhere('b.genre = :genre')
            ->setParameter('boite', $boite)
            ->setParameter('genre', $genre)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
