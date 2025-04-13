<?php

namespace App\Controller;

use App\Entity\Pokeballs;
use App\Repository\PokeballsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/pokeballs')]
class PokeballsController extends AbstractController
{
  private EntityManagerInterface $entityManager;
  private PokeballsRepository $pokeballsRepository;

  public function __construct(EntityManagerInterface $entityManager, PokeballsRepository $pokeballsRepository)
  {
    $this->entityManager = $entityManager;
    $this->pokeballsRepository = $pokeballsRepository;
  }

  // Ajouter une nouvelle Pokeball
  #[Route('/create', name: 'create_pokeball', methods: ['POST'])]
  public function createPokeball(Request $request): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    $pokeball = new Pokeballs();
    $pokeball->setNomPokeball($data['nomPokeball']);
    $pokeball->setNbPokemon($data['nbPokemon']);
    $pokeball->setNbShiny($data['nbShiny'] ?? null);

    $this->entityManager->persist($pokeball);
    $this->entityManager->flush();

    return $this->json($pokeball, Response::HTTP_CREATED);
  }

  // Récupérer toutes les Pokeballs pour le Pokedex
  #[Route('/all/pokedex', name: 'get_all_pokeballs_pokedex', methods: ['GET'])]
  public function getAllPokeballsForPokedex(): JsonResponse
  {
    $pokeballs = $this->pokeballsRepository->findAll();
    return $this->json($pokeballs);
  }

  // Récupérer toutes les Pokeballs pour l'Administration
  #[Route('/all/admin', name: 'get_all_pokeballs_admin', methods: ['GET'])]
  public function getAllPokeballsForAdmin(): JsonResponse
  {
    $pokeballs = $this->pokeballsRepository->findAll();
    return $this->json($pokeballs);
  }

  // Récupérer toutes les Pokeballs
  #[Route('/all', name: 'get_all_pokeballs', methods: ['GET'])]
  public function getAllPokeballs(): JsonResponse
  {
    $pokeballs = $this->pokeballsRepository->findAll();
    return $this->json($pokeballs);
  }

  // Récupérer les Pokeballs avec au moins un Pokémon
  #[Route('/available', name: 'get_available_pokeballs', methods: ['GET'])]
  public function getAvailablePokeballs(): JsonResponse
  {
    $pokeballs = $this->pokeballsRepository->findAllPokeballs();
    return $this->json($pokeballs);
  }

  // Récupérer une Pokeball par son ID (données complètes)
  #[Route('/find/{id}', name: 'get_pokeball_by_id', methods: ['GET'])]
  public function getPokeballById(int $id): JsonResponse
  {
    $pokeball = $this->pokeballsRepository->find($id);

    if (!$pokeball) {
      return $this->json(['message' => 'Pokeball non trouvée'], Response::HTTP_NOT_FOUND);
    }

    return $this->json($pokeball);
  }

  // Récupérer une Pokeball par son ID (nomPokeball seulement)
  #[Route('/{id}', name: 'get_pokeball_in_pokedex_by_id', methods: ['GET'])]
  public function getPokeballInPokedexById(int $id): JsonResponse
  {
    $pokeball = $this->pokeballsRepository->find($id);

    if (!$pokeball) {
      return $this->json(['message' => 'Pokeball non trouvée'], Response::HTTP_NOT_FOUND);
    }

    return $this->json(['nomPokeball' => $pokeball->getNomPokeball()]);
  }

  // Mettre à jour une Pokeball
  #[Route('/update', name: 'update_pokeball', methods: ['PATCH'])]
  public function updatePokeball(Request $request): JsonResponse
  {
    $data = json_decode($request->getContent(), true);
    $pokeball = $this->pokeballsRepository->find($data['id']);

    if (!$pokeball) {
      return $this->json(['message' => 'Pokeball non trouvée'], Response::HTTP_NOT_FOUND);
    }

    $pokeball->setNomPokeball($data['nomPokeball'] ?? $pokeball->getNomPokeball());
    $pokeball->setNbPokemon($data['nbPokemon'] ?? $pokeball->getNbPokemon());
    $pokeball->setNbShiny($data['nbShiny'] ?? $pokeball->getNbShiny());

    $this->entityManager->flush();

    return $this->json($pokeball);
  }

  // Supprimer une Pokeball par son ID
  #[Route('/delete/{id}', name: 'delete_pokeball_by_id', methods: ['DELETE'])]
  public function deletePokeballById(int $id): JsonResponse
  {
    $pokeball = $this->pokeballsRepository->find($id);

    if (!$pokeball) {
      return $this->json(['message' => 'Pokeball non trouvée'], Response::HTTP_NOT_FOUND);
    }

    $this->entityManager->remove($pokeball);
    $this->entityManager->flush();

    return $this->json(['message' => 'Pokeball supprimée']);
  }

  // Supprimer toutes les Pokeballs
  #[Route('/delete/all', name: 'delete_all_pokeballs', methods: ['DELETE'])]
  public function deleteAllPokeballs(): JsonResponse
  {
    $pokeballs = $this->pokeballsRepository->findAll();

    foreach ($pokeballs as $pokeball) {
      $this->entityManager->remove($pokeball);
    }

    $this->entityManager->flush();

    return $this->json(['message' => 'Toutes les Pokeballs ont été supprimées']);
  }
}
