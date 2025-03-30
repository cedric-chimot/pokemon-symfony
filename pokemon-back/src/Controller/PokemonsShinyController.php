<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PokemonShinyRepository;

class PokemonsShinyController extends AbstractController
{
  #[Route('/pokemon-shiny', name: 'app_pokemon_shiny')]
  public function index(): Response
  {
    return $this->render('pokemon-shiny/pokemon-shiny.html.twig');
  }

  #[Route('/admin-shiny', name: 'admin_shiny')]
  public function adminIndex(PokemonShinyRepository $shinyRepository): Response
  {
    // Récupérer tous les Pokémon shiny
    $shinies = $shinyRepository->findAll();

    // Regrouper par région
    $shiniesParRegion = [];
    foreach ($shinies as $pokemon) {
      $region = $pokemon->getDresseur()->getRegion()->getNomRegion();
      $shiniesParRegion[$region][] = $pokemon;
    }

    return $this->render('admin/shiny.html.twig', [
      'shiniesParRegion' => $shiniesParRegion
    ]);
  }

  #[Route('/api/pokemons/shiny', name: 'api_pokemons_shiny', methods: ['GET'])]
  public function getShinyPokemons(PokemonShinyRepository $shinyRepository): JsonResponse
  {
    $shiny = $shinyRepository->findAll();

    return $this->json($shiny, 200, [], ['groups' => 'pokemon:read']);
  }
}
