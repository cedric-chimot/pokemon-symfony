<?php

namespace App\Controller;

use App\Repository\PokedexNationalRepository;
use App\Entity\PokedexNational;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

#[Route('/api/pokedex-national')]
class PokedexNationalController extends AbstractController
{
  private PokedexNationalRepository $pokedexRepo;
  private EntityManagerInterface $em;

  public function __construct(PokedexNationalRepository $pokedexRepo, EntityManagerInterface $em)
  {
    $this->pokedexRepo = $pokedexRepo;
    $this->em = $em;
  }

  // Affichage page principale
  #[Route('', name: 'app_pokedex_national', methods: ['GET'])]
  public function index(): Response
  {
    return $this->render('pokedex-national/index.html.twig');
  }

  // Récupérer tous les Pokémon avec les relations
  #[Route('/all', name: 'get_all_pokedex_pokemon', methods: ['GET'])]
  public function getAllPokemon(): JsonResponse
  {
    $pokemons = $this->pokedexRepo->findAllPokemonsWithRelations();
    return $this->json($pokemons, 200, [], ['groups' => 'pokemon:read']);
  }

  // Récupérer un Pokémon par ID
  #[Route('/find/{id}', name: 'get_pokedex_pokemon_by_id', methods: ['GET'])]
  public function getPokemonById(int $id): JsonResponse
  {
    $pokemon = $this->pokedexRepo->find($id);

    if (!$pokemon) {
      return $this->json(['error' => 'Pokémon non trouvé'], 404);
    }

    return $this->json($pokemon, 200, [], ['groups' => 'pokemon:read']);
  }

  // Ajouter un Pokémon (exemple simple avec données JSON)
  #[Route('/create', name: 'create_pokedex_pokemon', methods: ['POST'])]
  public function createPokemon(Request $request): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    // Exemple simplifié : il faudrait valider et récupérer les entités associées
    $pokemon = new PokedexNational();
    $pokemon->setNumDex($data['numDex'] ?? '000')
            ->setNomPokemon($data['nomPokemon'] ?? 'Inconnu');

    // À compléter : setNature, setDresseur, etc. depuis leurs repositories

    $this->em->persist($pokemon);
    $this->em->flush();

    return $this->json(['message' => 'Pokémon ajouté avec succès'], 201);
  }

  // Mise à jour d’un Pokémon
  #[Route('/update/{id}', name: 'update_pokedex_pokemon', methods: ['PATCH'])]
  public function updatePokemon(int $id, Request $request): JsonResponse
  {
    $pokemon = $this->pokedexRepo->find($id);

    if (!$pokemon) {
      return $this->json(['error' => 'Pokémon non trouvé'], 404);
    }

    $data = json_decode($request->getContent(), true);

    if (isset($data['nomPokemon'])) {
      $pokemon->setNomPokemon($data['nomPokemon']);
    }

    if (isset($data['numDex'])) {
      $pokemon->setNumDex($data['numDex']);
    }

    // À compléter pour les autres champs si besoin

    $this->em->flush();

    return $this->json(['message' => 'Pokémon mis à jour']);
  }

  // Supprimer un Pokémon par son ID
  #[Route('/delete/{id}', name: 'delete_pokedex_pokemon_by_id', methods: ['DELETE'])]
  public function deletePokemonById(int $id): JsonResponse
  {
    $pokemon = $this->pokedexRepo->find($id);

    if (!$pokemon) {
      return $this->json(['error' => 'Pokémon non trouvé'], 404);
    }

    $this->em->remove($pokemon);
    $this->em->flush();

    return $this->json(['message' => 'Pokémon supprimé']);
  }

  // Supprimer tous les Pokémon
  #[Route('/delete/all', name: 'delete_all_pokedex_pokemon', methods: ['DELETE'])]
  public function deleteAllPokemon(): JsonResponse
  {
    $pokemons = $this->pokedexRepo->findAll();

    foreach ($pokemons as $pokemon) {
      $this->em->remove($pokemon);
    }

    $this->em->flush();

    return $this->json(['message' => 'Tous les Pokémon supprimés']);
  }
}
