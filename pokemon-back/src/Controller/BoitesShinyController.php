<?php

namespace App\Controller;

use App\Entity\Boites;
use App\Repository\BoitesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BoitesShinyController extends AbstractController
{
  private BoitesRepository $boitesRepository;

  public function __construct(BoitesRepository $boitesRepository)
  {
    $this->boitesRepository = $boitesRepository;
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

  #[Route('/boites-shiny', name: 'create_boite', methods: ['POST'])]
  public function save(Request $request): JsonResponse
  {
    $data = json_decode($request->getContent(), true);
    $boite = new Boites();
    $boite->setNom($data['nom']);
    $boite->setNbLevel100($data['nbLevel100']);

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
    $boite->setNom($data['nom']);
    $boite->setNbLevel100($data['nbLevel100']);

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

    return $stats ? $this->json($stats) : $this->json(['message' => 'Type inconnu'], 400);
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

  public function getRowspanForDex(array $pokemons, int $pokemonNumDex): int
  {
    // Compte combien de fois ce Pokémon apparaît dans la liste (même numDex)
    return count(array_filter($pokemons, fn($pokemon) => $pokemon['numDex'] === $pokemonNumDex));
  }

  public function getTypeColor(string $type): string
  {
    return $this->colorService->getTypeColor($type) ?? '#000000'; // Retourne une couleur par défaut si non trouvé
  }

}
