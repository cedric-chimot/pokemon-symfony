<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class TypesController extends AbstractController
{
  #[Route('/admin-types', name: 'admin_types')]
  public function adminIndex(): Response
  {
    return $this->render('admin/types.html.twig');
  }
}
