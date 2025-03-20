<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class PokemonsShinyController extends AbstractController
{
  #[Route('/pokemon-shiny', name: 'app_pokemon_shiny')]
  public function index(): Response
  {
    return $this->render('pokemon-shiny/pokemon-shiny.html.twig');
  }

  #[Route('/admin-shiny', name: 'admin_shiny')]
  public function adminIndex(): Response
  {
    return $this->render('admin/shiny.html.twig');
  }

  #[Route('/api/pokemons/shiny', name: 'api_pokemons_shiny', methods: ['GET'])]
  public function getShinyPokemons(PokemonShinyRepository $shinyRepository): JsonResponse
  {
    $shiny = $shinyRepository->findAll();

    return $this->json($shiny, 200, [], ['groups' => 'pokemon:read']);
  }
}
