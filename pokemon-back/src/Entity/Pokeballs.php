<?php

namespace App\Entity;

use App\Repository\PokeballsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

  /**
   * @var Collection<int, PokemonShiny>
   */
  #[ORM\OneToMany(targetEntity: PokemonShiny::class, mappedBy: 'pokeball')]
  private Collection $shinyList;

  public function __construct()
  {
      $this->shinyList = new ArrayCollection();
  }

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
          $shinyList->setPokeball($this);
      }

      return $this;
  }

  public function removeShinyList(PokemonShiny $shinyList): static
  {
      if ($this->shinyList->removeElement($shinyList)) {
          // set the owning side to null (unless already changed)
          if ($shinyList->getPokeball() === $this) {
              $shinyList->setPokeball(null);
          }
      }

      return $this;
  }
}
