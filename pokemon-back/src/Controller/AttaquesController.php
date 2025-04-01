<?php

namespace App\Controller;

use App\Entity\Attaques;
use App\Entity\Types;
use App\Repository\AttaquesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/attaques', name: 'attaques_')]
class AttaquesController extends AbstractController
{
  #[Route('/', name: 'index', methods: ['GET'])]
  public function index(AttaquesRepository $attaquesRepository): JsonResponse
  {
    $attaques = $attaquesRepository->findAll();
    $data = [];

    foreach ($attaques as $attaque) {
      $data[] = [
        'id' => $attaque->getId(),
        'nomAttaque' => $attaque->getNomAttaque(),
        'type' => $attaque->getType()->getNom(),
      ];
    }

    return $this->json($data);
  }

  #[Route('/all', name: 'admin_attaques', methods: ['GET'])]
  public function page(AttaquesRepository $attaquesRepository): Response
  {
    $attaques = $attaquesRepository->findAll();
    return $this->render('admin/attaques.html.twig', [
      'attaques' => $attaques,
    ]);
  }

  #[Route('/{id}', name: 'show', methods: ['GET'])]
  public function show(Attaques $attaque): JsonResponse
  {
    return $this->json([
      'id' => $attaque->getId(),
      'nomAttaque' => $attaque->getNomAttaque(),
      'type' => $attaque->getType()->getNom(),
    ]);
  }

  #[Route('/create', name: 'create', methods: ['POST'])]
  public function create(Request $request, EntityManagerInterface $em): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    $type = $em->getRepository(Types::class)->find($data['type_id']);
    if (!$type) {
      return $this->json(['error' => 'Type not found'], Response::HTTP_NOT_FOUND);
    }

    $attaque = new Attaques();
    $attaque->setNomAttaque($data['nomAttaque']);
    $attaque->setType($type);

    $em->persist($attaque);
    $em->flush();

    return $this->json(['message' => 'Attaque créée avec succès'], Response::HTTP_CREATED);
  }

  #[Route('/update/{id}', name: 'update', methods: ['PUT'])]
  public function update(Request $request, Attaques $attaque, EntityManagerInterface $em): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    if (isset($data['nomAttaque'])) {
      $attaque->setNomAttaque($data['nomAttaque']);
    }

    if (isset($data['type_id'])) {
      $type = $em->getRepository(Types::class)->find($data['type_id']);
      if (!$type) {
        return $this->json(['error' => 'Type not found'], Response::HTTP_NOT_FOUND);
      }
      $attaque->setType($type);
    }

    $em->flush();

    return $this->json(['message' => 'Attaque mise à jour avec succès']);
  }

  #[Route('/delete/{id}', name: 'delete', methods: ['DELETE'])]
  public function delete(Attaques $attaque, EntityManagerInterface $em): JsonResponse
  {
    $em->remove($attaque);
    $em->flush();

    return $this->json(['message' => 'Attaque supprimée avec succès']);
  }
}
