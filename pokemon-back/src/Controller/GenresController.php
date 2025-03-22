<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GenresController extends AbstractController
{
  #[Route('/admin-genres', name: 'admin_genres')]
  public function adminIndex(): Response
  {
    return $this->render('admin/genres.html.twig');
  }
}
