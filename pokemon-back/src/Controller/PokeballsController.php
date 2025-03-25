<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PokeballsController extends AbstractController
{
  #[Route('/admin-pokeballs', name: 'admin_pokeballs')]
  public function adminIndex(): Response
  {
    return $this->render('admin/pokeballs.html.twig');
  }
}
