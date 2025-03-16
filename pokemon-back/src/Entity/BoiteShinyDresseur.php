<?php

namespace App\Entity;

use App\Repository\BoiteShinyDresseurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BoiteShinyDresseurRepository::class)]
class BoiteShinyDresseur
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column]
  private ?int $nbPokemon = null;

  #[ORM\ManyToOne(inversedBy: 'boiteShinyDresseurs')]
  #[ORM\JoinColumn(nullable: false)]
  private ?BoitesShiny $boiteShiny = null;

  #[ORM\ManyToOne(inversedBy: 'boiteShinyDresseurs')]
  #[ORM\JoinColumn(nullable: false)]
  private ?Dresseurs $dresseur = null;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getNbPokemon(): ?int
  {
    return $this->nbPokemon;
  }

  public function setNbPokemon(int $nbPokemon): static
  {
    $this->nbPokemon = $nbPokemon;

    return $this;
  }

  public function getBoiteShiny(): ?BoitesShiny
  {
    return $this->boiteShiny;
  }

  public function setBoiteShiny(?BoitesShiny $boiteShiny): static
  {
    $this->boiteShiny = $boiteShiny;

    return $this;
  }

  public function getDresseur(): ?Dresseurs
  {
    return $this->dresseur;
  }

  public function setDresseur(?Dresseurs $dresseur): static
  {
    $this->dresseur = $dresseur;

    return $this;
  }
}
