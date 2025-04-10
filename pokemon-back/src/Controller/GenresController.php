<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenresController extends AbstractController
{
  private GenreRepository $genreRepository;
  private EntityManagerInterface $entityManager;

  public function __construct(GenreRepository $genreRepository, EntityManagerInterface $entityManager)
  {
    $this->genreRepository = $genreRepository;
    $this->entityManager = $entityManager;
  }

  #[Route('/admin-genres', name: 'admin_genres')]
  public function adminIndex(): Response
  {
    return $this->render('admin/genres.html.twig');
  }

  #[Route('/api/genres', name: 'get_genres', methods: ['GET'])]
  public function getAll(): JsonResponse
  {
    $genres = $this->genreRepository->findAll();
    return $this->json($genres);
  }

  #[Route('/api/genres/{id}', name: 'get_genre', methods: ['GET'])]
  public function getOne(int $id): JsonResponse
  {
    $genre = $this->genreRepository->find($id);
    if (!$genre) {
      return $this->json(['error' => 'Genre non trouvé'], 404);
    }
    return $this->json($genre);
  }

  #[Route('/api/genres', name: 'create_genre', methods: ['POST'])]
  public function create(Request $request): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    $genre = new Genre();
    $genre->setNom($data['nom'] ?? '');
    $genre->setNbTotal($data['nbTotal'] ?? 0);
    $genre->setNbShiny($data['nbShiny'] ?? 0);

    $this->entityManager->persist($genre);
    $this->entityManager->flush();

    return $this->json($genre, 201);
  }

  #[Route('/api/genres/{id}', name: 'update_genre', methods: ['PUT'])]
  public function update(Request $request, int $id): JsonResponse
  {
    $genre = $this->genreRepository->find($id);
    if (!$genre) {
      return $this->json(['error' => 'Genre non trouvé'], 404);
    }

    $data = json_decode($request->getContent(), true);

    $genre->setNbTotal($data['nbTotal'] ?? $genre->getNbTotal());
    $genre->setNbShiny($data['nbShiny'] ?? $genre->getNbShiny());

    $this->entityManager->flush();

    return $this->json($genre);
  }

  #[Route('/api/genres/{id}', name: 'delete_genre', methods: ['DELETE'])]
  public function delete(int $id): JsonResponse
  {
    $genre = $this->genreRepository->find($id);
    if (!$genre) {
      return $this->json(['error' => 'Genre non trouvé'], 404);
    }

    $this->entityManager->remove($genre);
    $this->entityManager->flush();

    return $this->json(['message' => 'Genre supprimé']);
  }

  #[Route('/api/genres', name: 'delete_all_genres', methods: ['DELETE'])]
  public function deleteAll(): JsonResponse
  {
    $genres = $this->genreRepository->findAll();
    foreach ($genres as $genre) {
      $this->entityManager->remove($genre);
    }
    $this->entityManager->flush();

    return $this->json(['message' => 'Tous les genres ont été supprimés']);
  }
}
