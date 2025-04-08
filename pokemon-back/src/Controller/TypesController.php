<?php

namespace App\Controller;

use App\Entity\Types;
use App\Repository\TypesRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

#[Route('/types')]
class TypeController extends AbstractController
{
  #[Route('/all', name: 'types_index', methods: ['GET'])]
  public function index(TypesRepository $typesRepository): JsonResponse
  {
    $types = $typesRepository->findAll();

    $data = array_map(fn($type) => [
      'id' => $type->getId(),
      'nom' => $type->getNom(),
      'nbShiny' => $type->getNbShiny()
    ], $types);

    return $this->json($data);
  }

  #[Route('/{id}', name: 'types_show', methods: ['GET'])]
  public function show(int $id, TypesRepository $typesRepository): JsonResponse
  {
    $type = $typesRepository->find($id);

    if (!$type) {
      return $this->json(['error' => 'Type non trouvé'], Response::HTTP_NOT_FOUND);
    }

    return $this->json([
      'id' => $type->getId(),
      'nom' => $type->getNom(),
      'nbShiny' => $type->getNbShiny()
    ]);
  }

  #[Route('/create', name: 'types_create', methods: ['POST'])]
  public function create(Request $request, TypesRepository $typesRepository): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    $type = new Types();
    $type->setNom($data['nom']);
    $type->setNbShiny($data['nbShiny'] ?? 0);

    $typesRepository->save($type, true);

    return $this->json([
      'message' => 'Type créé avec succès',
      'id' => $type->getId()
    ], Response::HTTP_CREATED);
  }

  #[Route('/update/{id}', name: 'types_update', methods: ['PUT'])]
  public function update(int $id, Request $request, TypesRepository $typesRepository): JsonResponse
  {
    $type = $typesRepository->find($id);

    if (!$type) {
      return $this->json(['error' => 'Type non trouvé'], Response::HTTP_NOT_FOUND);
    }

    $data = json_decode($request->getContent(), true);
    $type->setNbShiny($data['nbShiny']);

    $typesRepository->save($type, true);

    return $this->json(['message' => 'Type mis à jour']);
  }

  #[Route('/delete/{id}', name: 'types_delete', methods: ['DELETE'])]
  public function delete(int $id, TypesRepository $typesRepository): JsonResponse
  {
    $type = $typesRepository->find($id);

    if (!$type) {
      return $this->json(['error' => 'Type non trouvé'], Response::HTTP_NOT_FOUND);
    }

    $typesRepository->remove($type, true);

    return $this->json(['message' => 'Type supprimé']);
  }
}
