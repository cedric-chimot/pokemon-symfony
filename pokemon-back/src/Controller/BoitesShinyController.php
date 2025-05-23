<?php

namespace App\Controller;

use App\Entity\Boites;
use App\Repository\BoitesShinyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ColorsService;
use Symfony\Component\HttpFoundation\Response;

class BoitesShinyController extends AbstractController
{
  private BoitesShinyRepository $boitesRepository;
  private ColorsService $colorsService;

  public function __construct(BoitesShinyRepository $boitesRepository, ColorsService $colorsService)
  {
    $this->boitesRepository = $boitesRepository;
    $this->colorsService = $colorsService;
  }

  #[Route('/boites-shiny', name: 'app_boites_shiny', methods: ['GET'])]
  public function index(): JsonResponse
  {
    $boites = $this->boitesRepository->findAll();
    return $this->json($boites);
  }

  #[Route('/boites-shiny/{id}', name: 'get_boite', methods: ['GET'])]
  public function findBoiteById(int $id): JsonResponse
  {
    $boite = $this->boitesRepository->find($id);
    if (!$boite) {
      return $this->json(['message' => 'Boîte non trouvée'], 404);
    }

    return $this->json($boite);
  }

  #[Route('/boites-shiny', name: 'app_boites_shiny_create', methods: ['POST'])]
  public function save(Request $request): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    $boite = new Boites();
    $boite->setNom($data['nom'] ?? '');
    $boite->setNbLevel100($data['nbLevel100'] ?? 0);

    $this->boitesRepository->save($boite, true);

    return $this->json($boite, 201);
  }

  #[Route('/boites-shiny/{id}', name: 'update_boite', methods: ['PUT'])]
  public function updateBoite(Request $request, int $id): JsonResponse
  {
    $boite = $this->boitesRepository->find($id);
    if (!$boite) {
        return $this->json(['message' => 'Boîte non trouvée'], 404);
    }

    $data = json_decode($request->getContent(), true);
    $boite->setNom($data['nom'] ?? $boite->getNom());
    $boite->setNbLevel100($data['nbLevel100'] ?? $boite->getNbLevel100());

    $this->boitesRepository->save($boite, true);

    return $this->json($boite);
  }

  #[Route('/boites-shiny/{id}', name: 'delete_boite', methods: ['DELETE'])]
  public function deleteById(int $id): JsonResponse
  {
    $boite = $this->boitesRepository->find($id);
    if (!$boite) {
      return $this->json(['message' => 'Boîte non trouvée'], 404);
    }

    $this->boitesRepository->remove($boite, true);
    return $this->json(['message' => 'Boîte supprimée']);
  }

  #[Route('/boites-shiny/stats/{type}', name: 'stats_globales', methods: ['GET'])]
  public function getStatsGlobales(string $type): JsonResponse
  {
    $stats = match ($type) {
      'pokeballs' => $this->boitesRepository->allStatsByPokeball(),
      'dresseurs' => $this->boitesRepository->allStatsByDresseur(),
      'natures'   => $this->boitesRepository->allStatsByNature(),
      'sexes'     => $this->boitesRepository->allStatsBySexe(),
      'types'     => $this->boitesRepository->allStatsByType(),
      default     => null
    };

    if (!$stats) {
      return $this->json(['message' => 'Type inconnu'], 400);
    }

    // Ajouter les couleurs si c’est types ou natures
    if ($type === 'types') {
      foreach ($stats as &$stat) {
        $stat['couleur'] = $this->colorsService->getColorByType($stat['label']);
      }
    }

    if ($type === 'natures') {
      foreach ($stats as &$stat) {
        $stat['couleur'] = $this->colorsService->getColorByNature($stat['label']);
      }
    }

    return $this->json($stats);
  }

  #[Route('/boites-shiny/stats/{type}/{id}', name: 'stats_par_boite', methods: ['GET'])]
  public function getStatsByBoite(string $type, int $id): JsonResponse
  {
    $stats = match ($type) {
      'pokeballs' => $this->boitesRepository->statsByBoitePokeball($id),
      'dresseurs' => $this->boitesRepository->statsByBoiteDresseur($id),
      'natures'   => $this->boitesRepository->statsByBoiteNature($id),
      'sexes'     => $this->boitesRepository->statsByBoiteSexe($id),
      'types'     => $this->boitesRepository->statsByBoiteType($id),
      default     => null
    };

    return $stats ? $this->json($stats) : $this->json(['message' => 'Type inconnu'], 400);
  }
}
