<?php

namespace App\Controller;

use App\Entity\Boites;
use App\Entity\Dresseurs;
use App\Repository\BoiteDresseurRepository;
use App\Repository\BoitesRepository;
use App\Repository\DresseursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoiteShinyDresseurController extends AbstractController
{
  /**
   * Affiche la page principale
   *
   * @Route("/boite/shiny/dresseur", name="app_boite_shiny_dresseur")
   */
  public function index(): Response
  {
    return $this->render('boite_shiny_dresseur/index.html.twig', [
      'controller_name' => 'BoiteShinyDresseurController',
    ]);
  }

  /**
   * Met à jour la boîte d'un dresseur (ajout d'un Pokémon)
   *
   * @Route("/boite/shiny/dresseur/update", name="update_boite_dresseur", methods={"POST"})
   */
  public function updateBoiteDresseur(Request $request, DresseursRepository $dresseursRepository, BoitesRepository $boitesRepository, BoiteDresseurRepository $boiteDresseurRepository): Response
  {
    $dresseurId = $request->get('dresseur_id');
    $boiteId = $request->get('boite_id');

    // Vérifier si les IDs sont valides
    $dresseur = $dresseursRepository->find($dresseurId);
    $boite = $boitesRepository->find($boiteId);

    if (!$dresseur || !$boite) {
      return new Response('Dresseur ou Boîte non trouvé.', Response::HTTP_BAD_REQUEST);
    }

    // Chercher si la relation existe déjà
    $boiteDresseur = $boiteDresseurRepository->findBy(['boite' => $boite, 'dresseur' => $dresseur]);

    if ($boiteDresseur) {
      // Si la relation existe, incrémenter le nombre de Pokémon
      $boiteDresseur[0]->setNbPokemon($boiteDresseur[0]->getNbPokemon() + 1);
      $boiteDresseurRepository->save($boiteDresseur[0]);
    } else {
      // Sinon, créer une nouvelle entrée dans la table boite_dresseur
      $newBoiteDresseur = new BoiteDresseur();
      $newBoiteDresseur->setBoite($boite);
      $newBoiteDresseur->setDresseur($dresseur);
      $newBoiteDresseur->setNbPokemon(1);
      $boiteDresseurRepository->save($newBoiteDresseur);
    }

    return new Response('Pokémon ajouté à la boîte avec succès.');
  }

  /**
   * Décrémente le nombre de Pokémon dans une boîte dresseur
   *
   * @Route("/boite/shiny/dresseur/decrement", name="decrement_boite_dresseur", methods={"POST"})
   */
  public function decrementBoiteDresseur(Request $request, DresseursRepository $dresseursRepository, BoitesRepository $boitesRepository, BoiteDresseurRepository $boiteDresseurRepository): Response
  {
    $dresseurId = $request->get('dresseur_id');
    $boiteId = $request->get('boite_id');

    // Vérifier si les IDs sont valides
    $dresseur = $dresseursRepository->find($dresseurId);
    $boite = $boitesRepository->find($boiteId);

    if (!$dresseur || !$boite) {
      return new Response('Dresseur ou Boîte non trouvé.', Response::HTTP_BAD_REQUEST);
    }

    // Chercher la relation
    $boiteDresseur = $boiteDresseurRepository->findBy(['boite' => $boite, 'dresseur' => $dresseur]);

    if ($boiteDresseur) {
      // Décrémenter le nombre de Pokémon
      $boiteDresseur[0]->setNbPokemon($boiteDresseur[0]->getNbPokemon() - 1);
      if ($boiteDresseur[0]->getNbPokemon() <= 0) {
        $boiteDresseurRepository->remove($boiteDresseur[0]);
      } else {
        $boiteDresseurRepository->save($boiteDresseur[0]);
      }
      return new Response('Pokémon retiré de la boîte avec succès.');
    }

    return new Response('Relation non trouvée.', Response::HTTP_BAD_REQUEST);
  }

}
