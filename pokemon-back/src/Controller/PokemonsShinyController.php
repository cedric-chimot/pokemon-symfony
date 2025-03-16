<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class PokemonsShinyController extends AbstractController
{
  #[Route('/api/pokemons/shiny', name: 'api_pokemons_shiny', methods: ['GET'])]
  public function getShinyPokemons(PokemonShinyRepository $shinyRepository): JsonResponse
  {
    $shiny = $shinyRepository->findAll();

    return $this->json($shiny, 200, [], ['groups' => 'pokemon:read']);
  }
}
