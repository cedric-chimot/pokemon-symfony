<?php

namespace App\Controller;

use App\Repository\DresseursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DresseurController extends AbstractController
{
  private DresseursRepository $dresseursRepository;

  public function __construct(DresseursRepository $dresseursRepository)
  {
    $this->dresseursRepository = $dresseursRepository;
  }

  #[Route('/dresseurs/reduit', name: 'dresseurs_reduit')]
  public function reduit(): Response
  {
    $dresseurs = $this->dresseursRepository->findAllDresseursReduit();
    return $this->render('dresseur/liste.html.twig', ['dresseurs' => $dresseurs]);
  }

  #[Route('/dresseurs/region/{id}', name: 'dresseurs_region')]
  public function parRegion(int $id): Response
  {
    $dresseurs = $this->dresseursRepository->findAllDresseursByRegion($id);
    return $this->render('dresseur/liste.html.twig', ['dresseurs' => $dresseurs]);
  }

  #[Route('/dresseurs/region1/partie1', name: 'dresseurs_region1_part1')]
  public function region1Part1(): Response
  {
    $dresseurs = $this->dresseursRepository->findDresseursByRegionAndPart(1, 1, 40);
    return $this->render('dresseur/liste.html.twig', ['dresseurs' => $dresseurs]);
  }

  #[Route('/dresseurs/region1/partie2', name: 'dresseurs_region1_part2')]
  public function region1Part2(): Response
  {
    $dresseurs = $this->dresseursRepository->findDresseursByRegionAndPart(1, 41, 81);
    return $this->render('dresseur/liste.html.twig', ['dresseurs' => $dresseurs]);
  }

  #[Route('/dresseurs/count', name: 'dresseurs_count')]
  public function compter(): Response
  {
    $count = $this->dresseursRepository->countDresseurs();
    return $this->render('dresseur/count.html.twig', ['count' => $count]);
  }
}
