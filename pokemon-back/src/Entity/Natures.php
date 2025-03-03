<?php

namespace App\Entity;

use App\Repository\NaturesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NaturesRepository::class)]
class Natures
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $nomNature = null;

  #[ORM\Column]
  private ?int $nbPokemon = null;

  #[ORM\Column(nullable: true)]
  private ?int $nbShiny = null;

  /**
   * @var Collection<int, PokemonShiny>
   */
  #[ORM\OneToMany(targetEntity: PokemonShiny::class, mappedBy: 'nature')]
  private Collection $shinyList;

  public function __construct()
  {
      $this->shinyList = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getNomNature(): ?string
  {
    return $this->nomNature;
  }

  public function setNomNature(string $nomNature): static
  {
    $this->nomNature = $nomNature;

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
          $shinyList->setNature($this);
      }

      return $this;
  }

  public function removeShinyList(PokemonShiny $shinyList): static
  {
      if ($this->shinyList->removeElement($shinyList)) {
          // set the owning side to null (unless already changed)
          if ($shinyList->getNature() === $this) {
              $shinyList->setNature(null);
          }
      }

      return $this;
  }
}
