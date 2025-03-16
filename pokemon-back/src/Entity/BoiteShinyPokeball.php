<?php

namespace App\Entity;

use App\Repository\BoiteShinyPokeballRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BoiteShinyPokeballRepository::class)]
class BoiteShinyPokeball
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column]
  private ?int $nbPokemon = null;

  #[ORM\ManyToOne(inversedBy: 'boiteShinyPokeballs')]
  #[ORM\JoinColumn(nullable: false)]
  private ?BoitesShiny $boiteShiny = null;

  #[ORM\ManyToOne(inversedBy: 'boiteShinyPokeballs')]
  #[ORM\JoinColumn(nullable: false)]
  private ?Pokeballs $pokeball = null;

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

  public function getPokeball(): ?Pokeballs
  {
    return $this->pokeball;
  }

  public function setPokeball(?Pokeballs $pokeball): static
  {
    $this->pokeball = $pokeball;

    return $this;
  }
}
