<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class PokemonsShinyController extends AbstractController
{
  #[Route('/pokemons/shiny', name: 'app_pokemons_shiny')]
  public function index(): JsonResponse
  {
    return $this->json([
      'message' => 'Welcome to your new controller!',
      'path' => 'src/Controller/PokemonsShinyController.php',
    ]);
  }
}
