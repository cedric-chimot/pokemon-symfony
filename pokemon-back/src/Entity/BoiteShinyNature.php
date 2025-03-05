<?php

namespace App\Entity;

use App\Repository\BoiteShinyNatureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BoiteShinyNatureRepository::class)]
class BoiteShinyNature
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column]
  private ?int $nbPokemon = null;

  #[ORM\ManyToOne(inversedBy: 'boiteShinyNatures')]
  #[ORM\JoinColumn(nullable: false)]
  private ?BoitesShiny $boiteShiny = null;

  #[ORM\ManyToOne(inversedBy: 'boiteShinyNatures')]
  #[ORM\JoinColumn(nullable: false)]
  private ?Natures $nature = null;

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

  public function getNature(): ?Natures
  {
    return $this->nature;
  }

  public function setNature(?Natures $nature): static
  {
    $this->nature = $nature;

    return $this;
  }
}
