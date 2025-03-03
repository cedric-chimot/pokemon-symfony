<?php

namespace App\Entity;

use App\Repository\BoitePokedexNationalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BoitePokedexNationalRepository::class)]
class BoitePokedexNational
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $nomBoite = null;

  #[ORM\Column]
  private ?int $nbMales = null;

  #[ORM\Column]
  private ?int $nbFemelles = null;

  #[ORM\Column]
  private ?int $nbAssexues = null;

  #[ORM\Column]
  private ?int $nbLevel100 = null;

  /**
   * @var Collection<int, PokedexNational>
   */
  #[ORM\OneToMany(targetEntity: PokedexNational::class, mappedBy: 'boitePokedex')]
  private Collection $pokemonList;

  public function __construct()
  {
    $this->pokemonList = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getNomBoite(): ?string
  {
    return $this->nomBoite;
  }

  public function setNomBoite(string $nomBoite): static
  {
    $this->nomBoite = $nomBoite;

    return $this;
  }

  public function getNbMales(): ?int
  {
    return $this->nbMales;
  }

  public function setNbMales(int $nbMales): static
  {
    $this->nbMales = $nbMales;

    return $this;
  }

  public function getNbFemelles(): ?int
  {
    return $this->nbFemelles;
  }

  public function setNbFemelles(int $nbFemelles): static
  {
    $this->nbFemelles = $nbFemelles;

    return $this;
  }

  public function getNbAssexues(): ?int
  {
    return $this->nbAssexues;
  }

  public function setNbAssexues(int $nbAssexues): static
  {
    $this->nbAssexues = $nbAssexues;

    return $this;
  }

  public function getNbLevel100(): ?int
  {
    return $this->nbLevel100;
  }

  public function setNbLevel100(int $nbLevel100): static
  {
    $this->nbLevel100 = $nbLevel100;

    return $this;
  }

  /**
   * @return Collection<int, PokedexNational>
   */
  public function getPokemon(): Collection
  {
    return $this->pokemonList;
  }

  public function addPokemon(PokedexNational $pokemonList): static
  {
    if (!$this->pokemonList->contains($pokemonList)) {
      $this->pokemonList->add($pokemonList);
      $pokemonList->setBoitePokedex($this);
    }

    return $this;
  }

  public function removePokemon(PokedexNational $pokemonList): static
  {
    if ($this->pokemonList->removeElement($pokemonList)) {
      // set the owning side to null (unless already changed)
      if ($pokemonList->getBoitePokedex() === $this) {
        $pokemonList->setBoitePokedex(null);
      }
    }

    return $this;
  }
}
