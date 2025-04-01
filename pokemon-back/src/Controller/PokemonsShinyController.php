<?php

namespace App\Controller;

use App\Entity\PokemonShiny;
use App\Repository\PokemonShinyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/pokemons/shiny')]
class PokemonsShinyController extends AbstractController
{
  #[Route('/', name: 'app_pokemon_shiny', methods: ['GET'])]
  public function page(PokemonShinyRepository $shinyRepository): Response
  {
    $shinies = $shinyRepository->findAll();
    return $this->render('pokemons_shiny/index.html.twig', [
      'shinies' => $shinies,
    ]);
  }

  #[Route('/{id}', name: 'api_pokemons_shiny_show', methods: ['GET'])]
  public function show(PokemonShiny $pokemonShiny): JsonResponse
  {
    return $this->json($pokemonShiny, 200, [], ['groups' => 'pokemon:read']);
  }

  #[Route('/create', name: 'api_pokemons_shiny_create', methods: ['POST'])]
  public function create(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    $pokemonShiny = $serializer->deserialize($request->getContent(), PokemonShiny::class, 'json');

    $entityManager->persist($pokemonShiny);
    $entityManager->flush();

    return $this->json($pokemonShiny, 201, [], ['groups' => 'pokemon:read']);
  }

  #[Route('/update/{id}', name: 'api_pokemons_shiny_update', methods: ['PUT'])]
  public function update(Request $request, PokemonShiny $pokemonShiny, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
  {
    $serializer->deserialize($request->getContent(), PokemonShiny::class, 'json', ['object_to_populate' => $pokemonShiny]);

    $entityManager->flush();

    return $this->json($pokemonShiny, 200, [], ['groups' => 'pokemon:read']);
  }

  #[Route('/delete/{id}', name: 'api_pokemons_shiny_delete', methods: ['DELETE'])]
  public function delete(PokemonShiny $pokemonShiny, EntityManagerInterface $entityManager): JsonResponse
  {
    $entityManager->remove($pokemonShiny);
    $entityManager->flush();

    return $this->json(['message' => 'Pokemon Shiny supprimé avec succès'], 204);
  }
}
