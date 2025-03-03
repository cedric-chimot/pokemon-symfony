<?php

namespace App\Entity;

use App\Repository\DresseursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

  /**
   * @var Collection<int, PokemonShiny>
   */
  #[ORM\OneToMany(targetEntity: PokemonShiny::class, mappedBy: 'dresseur')]
  private Collection $shinyList;

  public function __construct()
  {
      $this->shinyList = new ArrayCollection();
  }

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

  /**
   * @return Collection<int, PokemonShiny>
   */
  public function getShinyList(): Collection
  {
      return $this->shinyList;
  }

  public function addShinyList(PokemonShiny $shinyList): static
  {
      if (!$this->shinyList->contains($shinyList)) {
          $this->shinyList->add($shinyList);
          $shinyList->setDresseur($this);
      }

      return $this;
  }

  public function removeShinyList(PokemonShiny $shinyList): static
  {
      if ($this->shinyList->removeElement($shinyList)) {
          // set the owning side to null (unless already changed)
          if ($shinyList->getDresseur() === $this) {
              $shinyList->setDresseur(null);
          }
      }

      return $this;
  }
}
