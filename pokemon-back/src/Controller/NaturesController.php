<?php

namespace App\Controller;

use App\Entity\Natures;
use App\Repository\NaturesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/natures')]
class NaturesController extends AbstractController
{
  private NaturesRepository $repository;
  private EntityManagerInterface $em;

  public function __construct(NaturesRepository $repository, EntityManagerInterface $em)
  {
    $this->repository = $repository;
    $this->em = $em;
  }

  #[Route('/', name: 'natures_index', methods: ['GET'])]
  public function index(): JsonResponse
  {
    $natures = $this->repository->findAll();
    return $this->json($natures);
  }

  #[Route('/{id}', name: 'natures_show', methods: ['GET'])]
  public function show(int $id): JsonResponse
  {
    $nature = $this->repository->find($id);

    if (!$nature) {
      return $this->json(['message' => 'Nature non trouvée'], Response::HTTP_NOT_FOUND);
    }

    return $this->json($nature);
  }

  #[Route('/create', name: 'natures_create', methods: ['POST'])]
  public function create(Request $request): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    $nature = new Natures();
    $nature->setNom($data['nom'] ?? null);
    $nature->setNbPokemon($data['nbPokemon'] ?? 0);
    $nature->setNbShiny($data['nbShiny'] ?? 0);

    $this->em->persist($nature);
    $this->em->flush();

    return $this->json($nature, Response::HTTP_CREATED);
  }

  #[Route('/update/{id}', name: 'natures_update', methods: ['PUT'])]
  public function update(int $id, Request $request): JsonResponse
  {
    $nature = $this->repository->find($id);

    if (!$nature) {
      return $this->json(['message' => 'Nature non trouvée'], Response::HTTP_NOT_FOUND);
    }

    $data = json_decode($request->getContent(), true);

    $nature->setNom($data['nom'] ?? $nature->getNom());
    $nature->setNbPokemon($data['nbPokemon'] ?? $nature->getNbPokemon());
    $nature->setNbShiny($data['nbShiny'] ?? $nature->getNbShiny());

    $this->em->flush();

    return $this->json($nature);
  }

  #[Route('/delete/{id}', name: 'natures_delete', methods: ['DELETE'])]
  public function delete(int $id): JsonResponse
  {
    $nature = $this->repository->find($id);

    if (!$nature) {
      return $this->json(['message' => 'Nature non trouvée'], Response::HTTP_NOT_FOUND);
    }

    $this->em->remove($nature);
    $this->em->flush();

    return $this->json(['message' => 'Nature supprimée']);
  }

  #[Route('/delete', name: 'natures_delete_all', methods: ['DELETE'])]
  public function deleteAll(): JsonResponse
  {
    $natures = $this->repository->findAll();

    foreach ($natures as $nature) {
      $this->em->remove($nature);
    }

    $this->em->flush();

    return $this->json(['message' => 'Toutes les natures ont été supprimées']);
  }

  #[Route('/increment-pokemon/{id}', name: 'natures_increment_pokemon', methods: ['PATCH'])]
  public function incrementPokemon(int $id): JsonResponse
  {
    $nature = $this->repository->find($id);

    if (!$nature) {
      return $this->json(['message' => 'Nature non trouvée'], Response::HTTP_NOT_FOUND);
    }

    $nature->setNbPokemon($nature->getNbPokemon() + 1);
    $this->em->flush();

    return $this->json($nature);
  }

  #[Route('/increment-shiny/{id}', name: 'natures_increment_shiny', methods: ['PATCH'])]
  public function incrementShiny(int $id): JsonResponse
  {
    $nature = $this->repository->find($id);

    if (!$nature) {
      return $this->json(['message' => 'Nature non trouvée'], Response::HTTP_NOT_FOUND);
    }

    $nature->setNbShiny($nature->getNbShiny() + 1);
    $this->em->flush();

    return $this->json($nature);
  }
}
