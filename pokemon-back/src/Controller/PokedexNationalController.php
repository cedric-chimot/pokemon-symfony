<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/pokedex-national')]
class PokedexNationalController extends AbstractController
{
  // Afficher le Pokédex National
  #[Route('', name: 'app_pokedex_national', methods: ['GET'])]
  public function index(): Response
  {
    return $this->render('pokedex-national/index.html.twig');
  }

  // Afficher la page d'administration du Pokédex
  #[Route('/admin', name: 'admin_pokedex', methods: ['GET'])]
  public function adminIndex(): Response
  {
    return $this->render('admin/pokedex.html.twig');
  }

  // Récupérer tous les Pokémon du Pokédex National
  #[Route('/all', name: 'get_all_pokedex_pokemon', methods: ['GET'])]
  public function getAllPokemon(): Response
  {
    // Ici tu mettras la logique pour récupérer les Pokémon
    return $this->json(['message' => 'Liste des Pokémon du Pokédex National']);
  }

  // Récupérer un Pokémon par son ID
  #[Route('/find/{id}', name: 'get_pokedex_pokemon_by_id', methods: ['GET'])]
  public function getPokemonById(int $id): Response
  {
    // Ici tu mettras la logique pour récupérer un Pokémon par son ID
    return $this->json(['id' => $id, 'message' => 'Détails du Pokémon']);
  }

  // Ajouter un nouveau Pokémon
  #[Route('/create', name: 'create_pokedex_pokemon', methods: ['POST'])]
  public function createPokemon(): Response
  {
    // Ici tu mettras la logique pour ajouter un Pokémon
    return $this->json(['message' => 'Pokémon ajouté avec succès'], Response::HTTP_CREATED);
  }

  // Mettre à jour un Pokémon
  #[Route('/update', name: 'update_pokedex_pokemon', methods: ['PATCH'])]
  public function updatePokemon(): Response
  {
    // Ici tu mettras la logique pour mettre à jour un Pokémon
    return $this->json(['message' => 'Pokémon mis à jour']);
  }

  // Supprimer un Pokémon par son ID
  #[Route('/delete/{id}', name: 'delete_pokedex_pokemon_by_id', methods: ['DELETE'])]
  public function deletePokemonById(int $id): Response
  {
    // Ici tu mettras la logique pour supprimer un Pokémon
    return $this->json(['message' => 'Pokémon supprimé']);
  }

  // Supprimer tous les Pokémon du Pokédex
  #[Route('/delete/all', name: 'delete_all_pokedex_pokemon', methods: ['DELETE'])]
  public function deleteAllPokemon(): Response
  {
    // Ici tu mettras la logique pour supprimer tous les Pokémon
    return $this->json(['message' => 'Tous les Pokémon du Pokédex ont été supprimés']);
  }
}
