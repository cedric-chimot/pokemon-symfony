<?php

namespace App\Entity;

use App\Repository\NaturesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: NaturesRepository::class)]
class Natures
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  #[Groups(['nature:read', 'nature:write'])]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  #[Groups(['nature:read', 'nature:write'])]
  private ?string $nomNature = null;

  #[ORM\Column]
  #[Groups(['nature:read', 'nature:write'])]
  private ?int $nbPokemon = null;

  #[ORM\Column(nullable: true)]
  #[Groups(['nature:read', 'nature:write'])]
  private ?int $nbShiny = null;

  /**
   * @var Collection<int, PokemonShiny>
   */
  #[ORM\OneToMany(targetEntity: PokemonShiny::class, mappedBy: 'nature')]
  #[Groups(['nature:read'])]
  private Collection $shinyList;

  /**
   * @var Collection<int, PokedexNational>
   */
  #[ORM\OneToMany(targetEntity: PokedexNational::class, mappedBy: 'nature')]
  #[Groups(['nature:read'])]
  private Collection $pokemonList;

  /**
   * @var Collection<int, BoiteShinyNature>
   */
  #[ORM\OneToMany(targetEntity: BoiteShinyNature::class, mappedBy: 'nature')]
  #[Groups(['nature:read'])]
  private Collection $boiteShinyNatures;

  public function __construct()
  {
    $this->shinyList = new ArrayCollection();
    $this->pokemonList = new ArrayCollection();
    $this->boiteShinyNatures = new ArrayCollection();
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
  public function getShiny(): Collection
  {
    return $this->shinyList;
  }

  public function addShiny(PokemonShiny $shinyList): static
  {
    if (!$this->shinyList->contains($shinyList)) {
      $this->shinyList->add($shinyList);
      $shinyList->setNature($this);
    }

    return $this;
  }

  public function removeShiny(PokemonShiny $shinyList): static
  {
    if ($this->shinyList->removeElement($shinyList)) {
      if ($shinyList->getNature() === $this) {
        $shinyList->setNature(null);
      }
    }

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
      $pokemonList->setNature($this);
    }

    return $this;
  }

  public function removePokemon(PokedexNational $pokemonList): static
  {
    if ($this->pokemonList->removeElement($pokemonList)) {
      if ($pokemonList->getNature() === $this) {
        $pokemonList->setNature(null);
      }
    }

    return $this;
  }

  /**
   * @return Collection<int, BoiteShinyNature>
   */
  public function getBoiteShinyNatures(): Collection
  {
    return $this->boiteShinyNatures;
  }

  public function addBoiteShinyNature(BoiteShinyNature $boiteShinyNature): static
  {
    if (!$this->boiteShinyNatures->contains($boiteShinyNature)) {
      $this->boiteShinyNatures->add($boiteShinyNature);
      $boiteShinyNature->setNature($this);
    }

    return $this;
  }

  public function removeBoiteShinyNature(BoiteShinyNature $boiteShinyNature): static
  {
    if ($this->boiteShinyNatures->removeElement($boiteShinyNature)) {
      if ($boiteShinyNature->getNature() === $this) {
        $boiteShinyNature->setNature(null);
      }
    }

    return $this;
  }
}
