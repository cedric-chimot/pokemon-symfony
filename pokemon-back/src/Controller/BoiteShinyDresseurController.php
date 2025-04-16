<?php

namespace App\Controller;

use App\Entity\BoiteShinyDresseur;
use App\Repository\BoitesRepository;
use App\Repository\DresseursRepository;
use App\Repository\BoiteShinyDresseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoiteShinyDresseurController extends AbstractController
{
  /**
   * @Route("/boite/shiny/dresseur", name="app_boite_shiny_dresseur")
   */
  public function index(): Response
  {
    return $this->render('boite_shiny_dresseur/index.html.twig', [
      'controller_name' => 'BoiteShinyDresseurController',
    ]);
  }

  /**
   * @Route("/boite/shiny/dresseur/update", name="update_boite_dresseur", methods={"POST"})
   */
  public function updateBoiteDresseur(
    Request $request,
    DresseursRepository $dresseursRepository,
    BoitesRepository $boitesRepository,
    BoiteShinyDresseurRepository $boiteDresseurRepository
  ): Response {
    $dresseurId = $request->get('dresseur_id');
    $boiteId = $request->get('boite_id');

    $dresseur = $dresseursRepository->find($dresseurId);
    $boite = $boitesRepository->find($boiteId);

    if (!$dresseur || !$boite) {
      return new Response('Dresseur ou Boîte non trouvé.', Response::HTTP_BAD_REQUEST);
    }

    $boiteDresseur = $boiteDresseurRepository->findByBoiteAndDresseur($boite, $dresseur);

    if ($boiteDresseur) {
      $boiteDresseur->setNbPokemon($boiteDresseur->getNbPokemon() + 1);
      $boiteDresseurRepository->save($boiteDresseur);
    } else {
      $newBoiteDresseur = new BoiteShinyDresseur();
      $newBoiteDresseur->setBoiteShiny($boite);
      $newBoiteDresseur->setDresseur($dresseur);
      $newBoiteDresseur->setNbPokemon(1);
      $boiteDresseurRepository->save($newBoiteDresseur);
    }

    return new Response('Pokémon ajouté à la boîte avec succès.');
  }

  /**
   * @Route("/boite/shiny/dresseur/decrement", name="decrement_boite_dresseur", methods={"POST"})
   */
  public function decrementBoiteDresseur(
    Request $request,
    DresseursRepository $dresseursRepository,
    BoitesRepository $boitesRepository,
    BoiteShinyDresseurRepository $boiteDresseurRepository
  ): Response {
    $dresseurId = $request->get('dresseur_id');
    $boiteId = $request->get('boite_id');

    $dresseur = $dresseursRepository->find($dresseurId);
    $boite = $boitesRepository->find($boiteId);

    if (!$dresseur || !$boite) {
      return new Response('Dresseur ou Boîte non trouvé.', Response::HTTP_BAD_REQUEST);
    }

    $boiteDresseur = $boiteDresseurRepository->findByBoiteAndDresseur($boite, $dresseur);

    if ($boiteDresseur) {
      $boiteDresseur->setNbPokemon($boiteDresseur->getNbPokemon() - 1);
      if ($boiteDresseur->getNbPokemon() <= 0) {
        $boiteDresseurRepository->remove($boiteDresseur);
      } else {
        $boiteDresseurRepository->save($boiteDresseur);
      }
      return new Response('Pokémon retiré de la boîte avec succès.');
    }

    return new Response('Relation non trouvée.', Response::HTTP_BAD_REQUEST);
  }
}
