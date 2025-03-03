<?php

namespace App\Entity;

use App\Repository\DresseursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DresseursRepository::class)]
class Dresseurs
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $numDresseur = null;

  #[ORM\Column(length: 255)]
  private ?string $nomDresseur = null;

  #[ORM\Column]
  private ?int $nbPokemon = null;

  #[ORM\Column(nullable: true)]
  private ?int $nbShiny = null;

  #[ORM\ManyToOne(inversedBy: 'dresseurs')]
  private ?RegionDresseur $regionDresseur = null;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getNumDresseur(): ?string
  {
    return $this->numDresseur;
  }

  public function setNumDresseur(string $numDresseur): static
  {
    $this->numDresseur = $numDresseur;

    return $this;
  }

  public function getNomDresseur(): ?string
  {
    return $this->nomDresseur;
  }

  public function setNomDresseur(string $nomDresseur): static
  {
    $this->nomDresseur = $nomDresseur;

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

  public function getRegionDresseur(): ?RegionDresseur
  {
    return $this->regionDresseur;
  }

  public function setRegionDresseur(?RegionDresseur $regionDresseur): static
  {
    $this->regionDresseur = $regionDresseur;

    return $this;
  }
}
