<?php

namespace App\Entity;

use App\Repository\BoiteShinyTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BoiteShinyTypeRepository::class)]
class BoiteShinyType
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column]
  private ?int $nbPokemon = null;

  #[ORM\ManyToOne(inversedBy: 'boiteShinyTypes')]
  #[ORM\JoinColumn(nullable: false)]
  private ?BoitesShiny $boiteShiny = null;

  #[ORM\ManyToOne(inversedBy: 'boiteShinyTypes')]
  #[ORM\JoinColumn(nullable: false)]
  private ?Types $type = null;

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

  public function getType(): ?Types
  {
    return $this->type;
  }

  public function setType(?Types $type): static
  {
    $this->type = $type;

    return $this;
  }
}
