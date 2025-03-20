<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AttaquesController extends AbstractController
{
  #[Route('/admin-attaques', name: 'admin_attaques')]
  public function index(): Response
  {
    return $this->render('admin/attaques.html.twig');
  }
}
