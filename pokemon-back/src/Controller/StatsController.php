<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StatsController extends AbstractController
{
  #[Route('/stats-pokedex', name: 'app_stats_pokedex')]
  public function index(): Response
  {
    return $this->render('stats-pokedex/stats-pokedex.html.twig');
  }

  #[Route('/stats-generales', name: 'app_stats_generales')]
  public function index2(): Response
  {
    return $this->render('stats-generales/stats-generales.html.twig');
  }

  #[Route('/stats-boites', name: 'app_stats_boites')]
  public function index3(): Response
  {
    return $this->render('stats-boites/stats-boites.html.twig');
  }
}
