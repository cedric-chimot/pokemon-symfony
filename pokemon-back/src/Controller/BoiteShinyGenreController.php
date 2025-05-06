<?php

namespace App\Controller;

use App\Entity\Boite;
use App\Entity\Genre;
use App\Entity\BoiteShinyGenre;
use App\Repository\BoiteRepository;
use App\Repository\GenreRepository;
use App\Repository\BoiteShinyGenreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BoiteShinyGenreController extends AbstractController
{
  #[Route('/boite/shiny/genre/update/{boiteId}/{genreId}', name: 'app_boite_shiny_genre_update')]
  public function update(
    int $boiteId,
    int $genreId,
    BoiteRepository $boiteRepository,
    GenreRepository $genreRepository,
    BoiteShinyGenreRepository $boiteShinyGenreRepository,
    EntityManagerInterface $em
  ): Response {
    $boite = $boiteRepository->find($boiteId);
    $genre = $genreRepository->find($genreId);

    if (!$boite || !$genre) {
      return new Response("Boite ou genre introuvable", 404);
    }

    $boiteShinyGenre = $boiteShinyGenreRepository->findByBoiteAndGenre($boite, $genre);

    if ($boiteShinyGenre) {
      $boiteShinyGenre->setNbPokemon($boiteShinyGenre->getNbPokemon() + 1);
    } else {
      $boiteShinyGenre = new BoiteShinyGenre();
      $boiteShinyGenre->setBoite($boite);
      $boiteShinyGenre->setGenre($genre);
      $boiteShinyGenre->setNbPokemon(1);
      $em->persist($boiteShinyGenre);
    }

    $em->flush();

    return new Response("BoiteShinyGenre mis à jour");
  }

  #[Route('/boite/shiny/genre/decrement/{boiteId}/{genreId}', name: 'app_boite_shiny_genre_decrement')]
  public function decrement(
    int $boiteId,
    int $genreId,
    BoiteRepository $boiteRepository,
    GenreRepository $genreRepository,
    BoiteShinyGenreRepository $boiteShinyGenreRepository,
    EntityManagerInterface $em
  ): Response {
    $boite = $boiteRepository->find($boiteId);
    $genre = $genreRepository->find($genreId);

    if (!$boite || !$genre) {
      return new Response("Boite ou genre introuvable", 404);
    }

    $boiteShinyGenre = $boiteShinyGenreRepository->findByBoiteAndGenre($boite, $genre);

    if ($boiteShinyGenre) {
      $nb = $boiteShinyGenre->getNbPokemon() - 1;
      if ($nb <= 0) {
        $em->remove($boiteShinyGenre);
      } else {
        $boiteShinyGenre->setNbPokemon($nb);
      }
      $em->flush();
    }

    return new Response("BoiteShinyGenre décrémenté");
  }
}
