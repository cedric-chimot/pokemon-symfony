<?php

namespace App\Controller;

use App\Entity\BoiteShinyPokeball;
use App\Repository\BoitesShinyRepository;
use App\Repository\PokeballsRepository;
use App\Repository\BoiteShinyPokeballRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoiteShinyPokeballController extends AbstractController
{
  #[Route('/boite/shiny/pokeball', name: 'app_boite_shiny_pokeball')]
  public function index(): Response
  {
    return $this->render('boite_shiny_pokeball/index.html.twig', [
      'controller_name' => 'BoiteShinyPokeballController',
    ]);
  }

  #[Route('/boite/shiny/pokeball/update', name: 'update_boite_shiny_pokeball', methods: ['POST'])]
  public function update(
    Request $request,
    BoitesShinyRepository $boitesShinyRepository,
    PokeballsRepository $pokeballsRepository,
    BoiteShinyPokeballRepository $boiteShinyPokeballRepository
  ): Response {
    $boiteId = $request->get('boite_id');
    $pokeballId = $request->get('pokeball_id');

    $boite = $boitesShinyRepository->find($boiteId);
    $pokeball = $pokeballsRepository->find($pokeballId);

    if (!$boite || !$pokeball) {
      return new Response('Boîte ou Pokéball non trouvée.', Response::HTTP_BAD_REQUEST);
    }

    $relation = $boiteShinyPokeballRepository->findOneBy([
      'boiteShiny' => $boite,
      'pokeball' => $pokeball,
    ]);

    if ($relation) {
      $relation->setNbPokemon($relation->getNbPokemon() + 1);
    } else {
      $relation = new BoiteShinyPokeball();
      $relation->setBoiteShiny($boite);
      $relation->setPokeball($pokeball);
      $relation->setNbPokemon(1);
    }

    $boiteShinyPokeballRepository->save($relation, true);

    return new Response('Ajout ou mise à jour réussi.');
  }

  #[Route('/boite/shiny/pokeball/decrement', name: 'decrement_boite_shiny_pokeball', methods: ['POST'])]
  public function decrement(
    Request $request,
    BoitesShinyRepository $boitesShinyRepository,
    PokeballsRepository $pokeballsRepository,
    BoiteShinyPokeballRepository $boiteShinyPokeballRepository
  ): Response {
    $boiteId = $request->get('boite_id');
    $pokeballId = $request->get('pokeball_id');

    $boite = $boitesShinyRepository->find($boiteId);
    $pokeball = $pokeballsRepository->find($pokeballId);

    if (!$boite || !$pokeball) {
      return new Response('Boîte ou Pokéball non trouvée.', Response::HTTP_BAD_REQUEST);
    }

    $relation = $boiteShinyPokeballRepository->findOneBy([
        'boiteShiny' => $boite,
        'pokeball' => $pokeball,
    ]);

    if ($relation) {
      $relation->setNbPokemon($relation->getNbPokemon() - 1);

      if ($relation->getNbPokemon() <= 0) {
        $boiteShinyPokeballRepository->remove($relation, true);
      } else {
        $boiteShinyPokeballRepository->save($relation, true);
      }

      return new Response('Pokémon retiré avec succès.');
    }

    return new Response('Relation non trouvée.', Response::HTTP_BAD_REQUEST);
  }
}
