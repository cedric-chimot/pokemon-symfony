<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class RegionsDresseurController extends AbstractController
{
  #[Route('/regions/dresseur', name: 'app_regions_dresseur')]
  public function index(): JsonResponse
  {
    return $this->json([
      'message' => 'Welcome to your new controller!',
      'path' => 'src/Controller/RegionsDresseurController.php',
    ]);
  }
}
