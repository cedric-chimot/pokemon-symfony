<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class PokedexNationalController extends AbstractController
{
  #[Route('/pokedex/national', name: 'app_pokedex_national')]
  public function index(): JsonResponse
  {
    return $this->json([
      'message' => 'Welcome to your new controller!',
      'path' => 'src/Controller/PokedexNationalController.php',
    ]);
  }
}
