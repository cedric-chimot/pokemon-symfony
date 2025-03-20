<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PokedexNationalController extends AbstractController
{
  #[Route('/pokedex-national', name: 'app_pokedex_national')]
  public function index(): Response
  {
    return $this->render('pokedex-national/pokedex-national.html.twig');
  }

  #[Route('/admin-pokedex', name: 'admin_pokedex')]
  public function adminIndex(): Response
  {
    return $this->render('pokedex-national/pokedex.html.twig');
  }
}
