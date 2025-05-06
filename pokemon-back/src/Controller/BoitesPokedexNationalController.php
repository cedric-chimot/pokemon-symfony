<?php

namespace App\Controller;

use App\Entity\BoitePokedexNational;
use App\Repository\BoitePokedexNationalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoitePokedexNationalController extends AbstractController
{
  #[Route('/api/boites', name: 'boites_index', methods: ['GET'])]
  public function index(BoitePokedexNationalRepository $repository): JsonResponse
  {
    $boites = $repository->findAll();

    return $this->json($boites);
  }

  #[Route('/api/boites/{id}', name: 'boites_show', methods: ['GET'])]
  public function show(BoitePokedexNationalRepository $repository, int $id): JsonResponse
  {
    $boite = $repository->find($id);

    if (!$boite) {
      return $this->json(['message' => 'Boîte non trouvée.'], Response::HTTP_NOT_FOUND);
    }

    return $this->json($boite);
  }

  #[Route('/api/boites', name: 'boites_create', methods: ['POST'])]
  public function create(Request $request, BoitePokedexNationalRepository $repository): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    $boite = new BoitePokedexNational();
    $boite->setNomBoite($data['nomBoite'] ?? null);
    $boite->setNbMales($data['nbMales'] ?? 0);
    $boite->setNbFemelles($data['nbFemelles'] ?? 0);
    $boite->setNbAssexues($data['nbAssexues'] ?? 0);
    $boite->setNbLevel100($data['nbLevel100'] ?? 0);

    $em = $this->getDoctrine()->getManager();
    $em->persist($boite);
    $em->flush();

    return $this->json($boite, Response::HTTP_CREATED);
  }

  #[Route('/api/boites/{id}', name: 'boites_update', methods: ['PUT'])]
  public function update(Request $request, BoitePokedexNationalRepository $repository, int $id): JsonResponse
  {
    $boite = $repository->find($id);

    if (!$boite) {
      return $this->json(['message' => 'Boîte non trouvée.'], Response::HTTP_NOT_FOUND);
    }

    $data = json_decode($request->getContent(), true);

    $boite->setNomBoite($data['nomBoite'] ?? $boite->getNomBoite());
    $boite->setNbMales($data['nbMales'] ?? $boite->getNbMales());
    $boite->setNbFemelles($data['nbFemelles'] ?? $boite->getNbFemelles());
    $boite->setNbAssexues($data['nbAssexues'] ?? $boite->getNbAssexues());
    $boite->setNbLevel100($data['nbLevel100'] ?? $boite->getNbLevel100());

    $this->getDoctrine()->getManager()->flush();

    return $this->json($boite);
  }

  #[Route('/api/boites/{id}', name: 'boites_delete', methods: ['DELETE'])]
  public function delete(BoitePokedexNationalRepository $repository, int $id): JsonResponse
  {
    $boite = $repository->find($id);

    if (!$boite) {
      return $this->json(['message' => 'Boîte non trouvée.'], Response::HTTP_NOT_FOUND);
    }

    $em = $this->getDoctrine()->getManager();
    $em->remove($boite);
    $em->flush();

    return $this->json(['message' => 'Boîte supprimée avec succès.']);
  }

  #[Route('/api/boites', name: 'boites_delete_all', methods: ['DELETE'])]
  public function deleteAll(BoitePokedexNationalRepository $repository): JsonResponse
  {
    $em = $this->getDoctrine()->getManager();
    $boites = $repository->findAll();

    foreach ($boites as $boite) {
      $em->remove($boite);
    }

    $em->flush();

    return $this->json(['message' => 'Toutes les boîtes ont été supprimées.']);
  }
}
