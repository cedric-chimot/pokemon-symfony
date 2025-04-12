<?php

namespace App\Entity;

use App\Repository\PokedexNationalRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PokedexNationalRepository::class)]
class PokedexNational
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  #[Groups(['pokedex:read'])]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  #[Groups(['pokedex:read'])]
  private ?string $numDex = null;

  #[ORM\Column(length: 255)]
  #[Groups(['pokedex:read'])]
  private ?string $nomPokemon = null;

  #[ORM\ManyToOne(inversedBy: 'pokemonList')]
  #[ORM\JoinColumn(nullable: false)]
  #[Groups(['pokedex:read'])]
  private ?Natures $nature = null;

  #[ORM\ManyToOne(inversedBy: 'pokemonList')]
  #[ORM\JoinColumn(nullable: false)]
  #[Groups(['pokedex:read'])]
  private ?Dresseurs $dresseur = null;

  #[ORM\ManyToOne(inversedBy: 'pokemonList')]
  #[ORM\JoinColumn(nullable: false)]
  #[Groups(['pokedex:read'])]
  private ?Pokeballs $pokeball = null;

  #[ORM\ManyToOne(inversedBy: 'pokemonList')]
  #[ORM\JoinColumn(nullable: false)]
  #[Groups(['pokedex:read'])]
  private ?BoitePokedexNational $boitePokedex = null;

  #[ORM\ManyToOne(inversedBy: 'pokemonList')]
  #[ORM\JoinColumn(nullable: false)]
  #[Groups(['pokedex:read'])]
  private ?Regions $region = null;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getNumDex(): ?string
  {
    return $this->numDex;
  }

  public function setNumDex(string $numDex): static
  {
    $this->numDex = $numDex;

    return $this;
  }

  public function getNomPokemon(): ?string
  {
    return $this->nomPokemon;
  }

  public function setNomPokemon(string $nomPokemon): static
  {
    $this->nomPokemon = $nomPokemon;

    return $this;
  }

  public function getNature(): ?Natures
  {
    return $this->nature;
  }

  public function setNature(?Natures $nature): static
  {
    $this->nature = $nature;

    return $this;
  }

  public function getDresseur(): ?Dresseurs
  {
    return $this->dresseur;
  }

  public function setDresseur(?Dresseurs $dresseur): static
  {
    $this->dresseur = $dresseur;

    return $this;
  }

  public function getPokeball(): ?Pokeballs
  {
    return $this->pokeball;
  }

  public function setPokeball(?Pokeballs $pokeball): static
  {
    $this->pokeball = $pokeball;

    return $this;
  }

  public function getBoitePokedex(): ?BoitePokedexNational
  {
    return $this->boitePokedex;
  }

  public function setBoitePokedex(?BoitePokedexNational $boitePokedex): static
  {
    $this->boitePokedex = $boitePokedex;

    return $this;
  }

  public function getRegion(): ?Regions
  {
    return $this->region;
  }

  public function setRegion(?Regions $region): static
  {
    $this->region = $region;

    return $this;
  }
}
