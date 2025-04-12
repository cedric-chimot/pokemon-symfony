<?php

// src/Entity/Pokeballs.php

namespace App\Entity;

use App\Repository\PokeballsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PokeballsRepository::class)]
class Pokeballs
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  #[Groups(['pokeball:read', 'pokemon:read'])]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  #[Groups(['pokeball:read', 'pokemon:read'])]
  private ?string $nomPokeball = null;

  #[ORM\Column]
  #[Groups(['pokeball:read'])]
  private ?int $nbPokemon = null;

  #[ORM\Column(nullable: true)]
  #[Groups(['pokeball:read'])]
  private ?int $nbShiny = null;

  /**
   * @var Collection<int, PokemonShiny>
   */
  #[ORM\OneToMany(targetEntity: PokemonShiny::class, mappedBy: 'pokeball')]
  #[Groups(['pokeball:read'])]
  private Collection $shinyList;

  /**
   * @var Collection<int, PokedexNational>
   */
  #[ORM\OneToMany(targetEntity: PokedexNational::class, mappedBy: 'pokeball')]
  #[Groups(['pokeball:read'])]
  private Collection $pokemonList;

  /**
   * @var Collection<int, BoiteShinyPokeball>
   */
  #[ORM\OneToMany(targetEntity: BoiteShinyPokeball::class, mappedBy: 'pokeball')]
  #[Groups(['pokeball:read'])]
  private Collection $boiteShinyPokeballs;

  public function __construct()
  {
    $this->shinyList = new ArrayCollection();
    $this->pokemonList = new ArrayCollection();
    $this->boiteShinyPokeballs = new ArrayCollection();
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
  public function getShiny(): Collection
  {
    return $this->shinyList;
  }

  public function addShiny(PokemonShiny $shinyList): static
  {
    if (!$this->shinyList->contains($shinyList)) {
      $this->shinyList->add($shinyList);
      $shinyList->setPokeball($this);
    }

    return $this;
  }

  public function removeShiny(PokemonShiny $shinyList): static
  {
    if ($this->shinyList->removeElement($shinyList)) {
      if ($shinyList->getPokeball() === $this) {
        $shinyList->setPokeball(null);
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
      $pokemonList->setPokeball($this);
    }

    return $this;
  }

  public function removePokemon(PokedexNational $pokemonList): static
  {
    if ($this->pokemonList->removeElement($pokemonList)) {
      if ($pokemonList->getPokeball() === $this) {
        $pokemonList->setPokeball(null);
      }
    }

    return $this;
  }

  /**
   * @return Collection<int, BoiteShinyPokeball>
   */
  public function getBoiteShinyPokeballs(): Collection
  {
    return $this->boiteShinyPokeballs;
  }

  public function addBoiteShinyPokeball(BoiteShinyPokeball $boiteShinyPokeball): static
  {
    if (!$this->boiteShinyPokeballs->contains($boiteShinyPokeball)) {
      $this->boiteShinyPokeballs->add($boiteShinyPokeball);
      $boiteShinyPokeball->setPokeball($this);
    }

    return $this;
  }

  public function removeBoiteShinyPokeball(BoiteShinyPokeball $boiteShinyPokeball): static
  {
    if ($this->boiteShinyPokeballs->removeElement($boiteShinyPokeball)) {
      if ($boiteShinyPokeball->getPokeball() === $this) {
        $boiteShinyPokeball->setPokeball(null);
      }
    }

    return $this;
  }
}
