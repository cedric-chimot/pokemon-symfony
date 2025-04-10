<?php

namespace App\Controller;

use App\Entity\Dresseurs;
use App\Entity\RegionDresseur;
use App\Repository\DresseurRepository;
use App\Repository\RegionDresseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DresseurController extends AbstractController
{
  #[Route('/dresseurs', name: 'dresseurs_list')]
  public function index(DresseurRepository $repo): JsonResponse
  {
    $dresseurs = $repo->findAll();
    return $this->json($dresseurs);
  }

  #[Route('/dresseurs/{id}', name: 'dresseur_detail', methods: ['GET'])]
  public function show(DresseurRepository $repo, int $id): JsonResponse
  {
    $dresseur = $repo->find($id);
    if (!$dresseur) {
      return $this->json(['error' => 'Dresseur non trouvé'], 404);
    }
    return $this->json($dresseur);
  }

  #[Route('/dresseurs', name: 'dresseur_create', methods: ['POST'])]
  public function create(Request $request, DresseurRepository $repo, RegionDresseurRepository $regionRepo): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    $region = !empty($data['idRegionDresseur']) ? $regionRepo->find($data['idRegionDresseur']) : null;

    $dresseur = new Dresseurs();
    $dresseur->setNumDresseur($data['numDresseur'] ?? '');
    $dresseur->setNomDresseur($data['nomDresseur'] ?? '');
    $dresseur->setNbPokemon($data['nbPokemon'] ?? 0);
    $dresseur->setNbShiny($data['nbShiny'] ?? 0);
    $dresseur->setRegionDresseur($region);

    $repo->save($dresseur, true);

    return $this->json($dresseur);
  }

  #[Route('/dresseurs/{id}', name: 'dresseur_update', methods: ['PUT'])]
  public function update(Request $request, DresseurRepository $repo, RegionDresseurRepository $regionRepo, int $id): JsonResponse
  {
    $dresseur = $repo->find($id);
    if (!$dresseur) {
      return $this->json(['error' => 'Dresseur non trouvé'], 404);
    }

    $data = json_decode($request->getContent(), true);

    $region = !empty($data['idRegionDresseur']) ? $regionRepo->find($data['idRegionDresseur']) : null;

    $dresseur->setNumDresseur($data['numDresseur'] ?? $dresseur->getNumDresseur());
    $dresseur->setNomDresseur($data['nomDresseur'] ?? $dresseur->getNomDresseur());
    $dresseur->setNbPokemon($data['nbPokemon'] ?? $dresseur->getNbPokemon());
    $dresseur->setNbShiny($data['nbShiny'] ?? $dresseur->getNbShiny());
    $dresseur->setRegionDresseur($region ?? $dresseur->getRegionDresseur());

    $repo->save($dresseur, true);

    return $this->json($dresseur);
  }

  #[Route('/dresseurs/{id}', name: 'dresseur_delete', methods: ['DELETE'])]
  public function delete(DresseurRepository $repo, int $id): JsonResponse
  {
    $dresseur = $repo->find($id);
    if (!$dresseur) {
      return $this->json(['error' => 'Dresseur non trouvé'], 404);
    }

    $repo->remove($dresseur, true);
    return $this->json(['message' => 'Dresseur supprimé']);
  }

  #[Route('/dresseurs/{id}/increment-pokemon', name: 'dresseur_increment_pokemon', methods: ['POST'])]
  public function incrementPokemon(DresseurRepository $repo, int $id): JsonResponse
  {
    $dresseur = $repo->find($id);
    if (!$dresseur) {
      return $this->json(['error' => 'Dresseur non trouvé'], 404);
    }

    $dresseur->setNbPokemon($dresseur->getNbPokemon() + 1);
    $repo->save($dresseur, true);

    return $this->json($dresseur);
  }

  #[Route('/dresseurs/{id}/increment-shiny', name: 'dresseur_increment_shiny', methods: ['POST'])]
  public function incrementShiny(DresseurRepository $repo, int $id): JsonResponse
  {
    $dresseur = $repo->find($id);
    if (!$dresseur) {
      return $this->json(['error' => 'Dresseur non trouvé'], 404);
    }

    $dresseur->setNbShiny($dresseur->getNbShiny() + 1);
    $repo->save($dresseur, true);

    return $this->json($dresseur);
  }

  #[Route('/dresseurs/count', name: 'dresseur_count', methods: ['GET'])]
  public function count(DresseurRepository $repo): JsonResponse
  {
    $count = $repo->count([]);
    return $this->json(['count' => $count]);
  }
}
