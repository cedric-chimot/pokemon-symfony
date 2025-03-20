<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BoitesPokedexNationalController extends AbstractController
{
  #[Route('/admin-boites-pokedex', name: 'admin_boite_pokedex')]
  public function index(): Response
  {
    {
      return $this->render('admin/boites-pokedex.html.twig');
    }
  }
}
