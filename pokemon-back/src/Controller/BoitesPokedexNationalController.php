<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class BoitesPokedexNationalController extends AbstractController
{
  #[Route('/boites/pokedex/national', name: 'app_boites_pokedex_national')]
  public function index(): JsonResponse
  {
    return $this->json([
      'message' => 'Welcome to your new controller!',
      'path' => 'src/Controller/BoitesPokedexNationalController.php',
    ]);
  }
}
