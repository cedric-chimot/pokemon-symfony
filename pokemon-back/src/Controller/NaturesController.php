<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NaturesController extends AbstractController
{
  #[Route('/admin-natures', name: 'admin_natures')]
  public function adminIndex(): Response
  {
    return $this->render('admin/natures.html.twig');
  }
}
