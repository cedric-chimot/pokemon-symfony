<?php

namespace App\Entity;

use App\Repository\PokemonShinyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonShinyRepository::class)]
class PokemonShiny
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $numDex = null;

  #[ORM\Column(length: 255)]
  private ?string $nomPokemon = null;

  #[ORM\Column(length: 255)]
  private ?string $ivManquants = null;

  #[ORM\Column]
  private ?int $position = null;

  #[ORM\ManyToOne(inversedBy: 'shinyList')]
  #[ORM\JoinColumn(nullable: false)]
  private ?Natures $nature = null;

  #[ORM\ManyToOne(inversedBy: 'shinyList')]
  #[ORM\JoinColumn(nullable: false)]
  private ?Dresseurs $dresseur = null;

  #[ORM\ManyToOne(inversedBy: 'shinyList')]
  #[ORM\JoinColumn(nullable: false)]
  private ?Pokeballs $pokeball = null;

  #[ORM\ManyToOne(inversedBy: 'shinyList')]
  #[ORM\JoinColumn(nullable: false)]
  private ?Types $type1 = null;

  #[ORM\ManyToOne(inversedBy: 'shinyListType2')]
  private ?Types $type2 = null;

  #[ORM\ManyToOne(inversedBy: 'shinyList')]
  #[ORM\JoinColumn(nullable: false)]
  private ?Genres $genre = null;

  #[ORM\ManyToOne(inversedBy: 'pokemonShiniesAttaque1')]
  private ?Attaques $attaque1 = null;

  #[ORM\ManyToOne(inversedBy: 'pokemonShiniesAttaque2')]
  private ?Attaques $attaque2 = null;

  #[ORM\ManyToOne(inversedBy: 'pokemonShiniesAttaque3')]
  private ?Attaques $attaque3 = null;

  #[ORM\ManyToOne(inversedBy: 'pokemonShiniesAttaque4')]
  private ?Attaques $attaque4 = null;

  #[ORM\ManyToOne(inversedBy: 'shinyList')]
  #[ORM\JoinColumn(nullable: false)]
  private ?BoitesShiny $boite = null;

  #[ORM\ManyToOne(inversedBy: 'shinyList')]
  #[ORM\JoinColumn(nullable: false)]
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

  public function getIvManquants(): ?string
  {
    return $this->ivManquants;
  }

  public function setIvManquants(string $ivManquants): static
  {
    $this->ivManquants = $ivManquants;

    return $this;
  }

  public function getPosition(): ?int
  {
    return $this->position;
  }

  public function setPosition(int $position): static
  {
    $this->position = $position;

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

  public function getType1(): ?Types
  {
    return $this->type1;
  }

  public function setType1(?Types $type1): static
  {
    $this->type1 = $type1;

    return $this;
  }

  public function getType2(): ?Types
  {
    return $this->type2;
  }

  public function setType2(?Types $type2): static
  {
    $this->type2 = $type2;

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

  public function getAttaque1(): ?Attaques
  {
    return $this->attaque1;
  }

  public function setAttaque1(?Attaques $attaque1): static
  {
    $this->attaque1 = $attaque1;

    return $this;
  }

  public function getAttaque2(): ?Attaques
  {
    return $this->attaque2;
  }

  public function setAttaque2(?Attaques $attaque2): static
  {
    $this->attaque2 = $attaque2;

    return $this;
  }

  public function getAttaque3(): ?Attaques
  {
    return $this->attaque3;
  }

  public function setAttaque3(?Attaques $attaque3): static
  {
    $this->attaque3 = $attaque3;

    return $this;
  }

  public function getAttaque4(): ?Attaques
  {
    return $this->attaque4;
  }

  public function setAttaque4(?Attaques $attaque4): static
  {
    $this->attaque4 = $attaque4;

    return $this;
  }

  public function getBoite(): ?BoitesShiny
  {
    return $this->boite;
  }

  public function setBoite(?BoitesShiny $boite): static
  {
    $this->boite = $boite;

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
