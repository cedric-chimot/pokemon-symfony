<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
  #[Route('/admin', name: 'admin')]
  public function index(): Response
  {
    return $this->render('admin/dashboard.html.twig');
  }

  #[Route('/admin-pokedex', name: 'admin_pokedex', methods: ['GET'])]
  public function adminIndex(): Response
  {
    return $this->render('admin/pokedex.html.twig');
  }

  #[Route('/admin-boites-pokedex', name: 'admin_boite_pokedex')]
  public function adminBoitesPokedex(): Response
  {
    return $this->render('admin/boites-pokedex.html.twig');
  }

  #[Route('/admin-shiny', name: 'admin_shiny')]
  public function adminShiny(): Response
  {
    return $this->render('admin/shiny.html.twig');
  }

  #[Route('/admin-boites-shiny', name: 'admin_boite_shiny')]
  public function adminBoitesShiny(): Response
  {
    return $this->render('admin/boites-shiny.html.twig');
  }

  #[Route('/admin-attaques', name: 'admin_attaques')]
  public function adminAttaques(): Response
  {
    return $this->render('admin/attaques.html.twig');
  }

  #[Route('/admin-dresseurs', name: 'admin_dresseurs')]
  public function adminDresseurs(): Response
  {
    return $this->render('admin/dresseurs.html.twig');
  }

  #[Route('/admin-genres', name: 'admin_genres')]
  public function adminGenres(): Response
  {
    return $this->render('admin/genres.html.twig');
  }

  #[Route('/admin-regions', name: 'admin_regions')]
  public function adminRegions(): Response
  {
    return $this->render('admin/regions.html.twig');
  }

  #[Route('/admin-types', name: 'admin_types')]
  public function adminTypes(): Response
  {
    return $this->render('admin/types.html.twig');
  }

}
