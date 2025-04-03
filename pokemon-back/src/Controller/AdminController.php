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

  #[Route('/admin-boites-pokedex', name: 'admin_boite_pokedex')]
  public function boitesPokedex(): Response
  {
    return $this->render('admin/boites-pokedex.html.twig');
  }

  #[Route('/admin-shiny', name: 'admin_shiny')]
  public function shinyList(): Response
  {
    return $this->render('admin/shiny.html.twig');
  }

}
