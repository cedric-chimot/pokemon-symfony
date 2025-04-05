<?php

namespace App\Controller;

use App\Entity\Regions;
use App\Repository\RegionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Contrôleur pour gérer les régions
 */
class RegionsController extends AbstractController
{
  /**
   * Liste toutes les régions
   */
  #[Route('/regions', name: 'regions_list', methods: ['GET'])]
  public function list(RegionRepository $regionRepository): JsonResponse
  {
    $regions = $regionRepository->findAll();
    return $this->json($regions);
  }

  /**
   * Crée une nouvelle région
   */
  #[Route('/regions', name: 'regions_create', methods: ['POST'])]
  public function create(Request $request, EntityManagerInterface $em): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    $region = new Regions();
    $region->setNomRegion($data['nomRegion'] ?? '');

    $em->persist($region);
    $em->flush();

    return $this->json($region, Response::HTTP_CREATED);
  }

  /**
   * Affiche une région par ID
   */
  #[Route('/regions/{id}', name: 'regions_show', methods: ['GET'])]
  public function show(RegionRepository $regionRepository, int $id): JsonResponse
  {
    $region = $regionRepository->find($id);

    if (!$region) {
      return $this->json(['message' => 'Région non trouvée'], Response::HTTP_NOT_FOUND);
    }

    return $this->json($region);
  }

  /**
   * Met à jour une région
   */
  #[Route('/regions/{id}', name: 'regions_update', methods: ['PUT'])]
  public function update(Request $request, RegionRepository $regionRepository, EntityManagerInterface $em, int $id): JsonResponse
  {
    $region = $regionRepository->find($id);

    if (!$region) {
      return $this->json(['message' => 'Région non trouvée'], Response::HTTP_NOT_FOUND);
    }

    $data = json_decode($request->getContent(), true);
    $region->setNomRegion($data['nomRegion'] ?? $region->getNomRegion());

    $em->flush();

    return $this->json($region);
  }

  /**
   * Supprime une région
   */
  #[Route('/regions/{id}', name: 'regions_delete', methods: ['DELETE'])]
  public function delete(RegionRepository $regionRepository, EntityManagerInterface $em, int $id): JsonResponse
  {
    $region = $regionRepository->find($id);

    if (!$region) {
      return $this->json(['message' => 'Région non trouvée'], Response::HTTP_NOT_FOUND);
    }

    $em->remove($region);
    $em->flush();

    return $this->json(['message' => 'Région supprimée']);
  }

  /**
   * Supprime toutes les régions
   */
  #[Route('/regions', name: 'regions_delete_all', methods: ['DELETE'])]
  public function deleteAll(RegionRepository $regionRepository, EntityManagerInterface $em): JsonResponse
  {
    $regions = $regionRepository->findAll();

    foreach ($regions as $region) {
      $em->remove($region);
    }

    $em->flush();

    return $this->json(['message' => 'Toutes les régions ont été supprimées']);
  }

  /**
   * Compte le nombre de régions
   */
  #[Route('/regions/count', name: 'regions_count', methods: ['GET'])]
  public function count(RegionRepository $regionRepository): JsonResponse
  {
    $count = $regionRepository->count([]);
    return $this->json(['count' => $count]);
  }
}
