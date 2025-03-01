<?php

namespace App\Entity;

use App\Repository\GenresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenresRepository::class)]
class Genres
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $genre = null;

  #[ORM\Column]
  private ?int $nbPokemon = null;

  #[ORM\Column]
  private ?int $nbShiny = null;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getGenre(): ?string
  {
    return $this->genre;
  }

  public function setGenre(string $genre): static
  {
    $this->genre = $genre;

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

  public function setNbShiny(int $nbShiny): static
  {
    $this->nbShiny = $nbShiny;

    return $this;
  }
}
