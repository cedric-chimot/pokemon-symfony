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
}
