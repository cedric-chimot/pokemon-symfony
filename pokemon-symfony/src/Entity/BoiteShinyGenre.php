<?php

namespace App\Entity;

use App\Repository\BoiteShinyGenreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BoiteShinyGenreRepository::class)]
class BoiteShinyGenre
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column]
  private ?int $nbPokemon = null;

  #[ORM\ManyToOne(inversedBy: 'boiteShinyGenres')]
  #[ORM\JoinColumn(nullable: false)]
  private ?BoitesShiny $boiteShiny = null;

  #[ORM\ManyToOne(inversedBy: 'boiteShinyGenres')]
  #[ORM\JoinColumn(nullable: false)]
  private ?Genres $genre = null;

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

  public function getGenre(): ?Genres
  {
    return $this->genre;
  }

  public function setGenre(?Genres $genre): static
  {
    $this->genre = $genre;

    return $this;
  }
}
