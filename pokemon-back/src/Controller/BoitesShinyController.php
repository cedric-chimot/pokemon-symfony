<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BoitesShinyController extends AbstractController
{
  #[Route('/boites-shiny', name: 'app_boites_shiny')]
  public function index(): Response
  {
    return $this->render('boites-shiny/boites-shiny.html.twig');
  }

  #[Route('/admin-boites-shiny', name: 'admin_boite_shiny')]
  public function adminIndex(): Response
  {
    {
      return $this->render('admin/boites-shiny.html.twig');
    }
  }
}
