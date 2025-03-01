<?php

namespace App\Entity;

use App\Repository\PokeballsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokeballsRepository::class)]
class Pokeballs
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $nomPokeball = null;

  #[ORM\Column]
  private ?int $nbPokemon = null;

  #[ORM\Column(nullable: true)]
  private ?int $nbShiny = null;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getNomPokeball(): ?string
  {
    return $this->nomPokeball;
  }

  public function setNomPokeball(string $nomPokeball): static
  {
    $this->nomPokeball = $nomPokeball;

    return $this;
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

  public function getNbShiny(): ?int
  {
    return $this->nbShiny;
  }

  public function setNbShiny(?int $nbShiny): static
  {
    $this->nbShiny = $nbShiny;

    return $this;
  }
}
