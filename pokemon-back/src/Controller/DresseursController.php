<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DresseursController extends AbstractController
{
  #[Route('/admin-dresseurs', name: 'admin_dresseurs')]
  public function index(): Response
  {
    {
      return $this->render('admin/dresseurs.html.twig');
    }
  }
}
