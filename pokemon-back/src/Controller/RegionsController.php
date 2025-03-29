<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RegionsController extends AbstractController
{
  #[Route('/admin-regions', name: 'admin_regions')]
  public function index(): Response
  {
    return $this->render('admin/regions.html.twig');
  }
}
