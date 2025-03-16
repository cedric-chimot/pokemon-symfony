<?php

namespace App\Entity;

use App\Repository\BoitesShinyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BoitesShinyRepository::class)]
class BoitesShiny
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $nom = null;

  #[ORM\Column]
  private ?int $nbLevel100 = null;

  /**
   * @var Collection<int, PokemonShiny>
   */
  #[ORM\OneToMany(targetEntity: PokemonShiny::class, mappedBy: 'boite')]
  private Collection $shinyList;

  /**
   * @var Collection<int, BoiteShinyDresseur>
   */
  #[ORM\OneToMany(targetEntity: BoiteShinyDresseur::class, mappedBy: 'boiteShiny')]
  private Collection $boiteShinyDresseurs;

  /**
   * @var Collection<int, BoiteShinyNature>
   */
  #[ORM\OneToMany(targetEntity: BoiteShinyNature::class, mappedBy: 'boiteShiny')]
  private Collection $boiteShinyNatures;

  /**
   * @var Collection<int, BoiteShinyPokeball>
   */
  #[ORM\OneToMany(targetEntity: BoiteShinyPokeball::class, mappedBy: 'boiteShiny')]
  private Collection $boiteShinyPokeballs;

  /**
   * @var Collection<int, BoiteShinyGenre>
   */
  #[ORM\OneToMany(targetEntity: BoiteShinyGenre::class, mappedBy: 'boiteShiny')]
  private Collection $boiteShinyGenres;

  /**
   * @var Collection<int, BoiteShinyType>
   */
  #[ORM\OneToMany(targetEntity: BoiteShinyType::class, mappedBy: 'boiteShiny')]
  private Collection $boiteShinyTypes;

  public function __construct()
  {
    $this->shinyList = new ArrayCollection();
    $this->boiteShinyDresseurs = new ArrayCollection();
    $this->boiteShinyNatures = new ArrayCollection();
    $this->boiteShinyPokeballs = new ArrayCollection();
    $this->boiteShinyGenres = new ArrayCollection();
    $this->boiteShinyTypes = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getNom(): ?string
  {
    return $this->nom;
  }

  public function setNom(string $nom): static
  {
    $this->nom = $nom;

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
      $shinyList->setBoite($this);
    }

    return $this;
  }

  public function removeShinyList(PokemonShiny $shinyList): static
  {
    if ($this->shinyList->removeElement($shinyList)) {
      // set the owning side to null (unless already changed)
      if ($shinyList->getBoite() === $this) {
        $shinyList->setBoite(null);
      }
    }

    return $this;
  }

  /**
   * @return Collection<int, BoiteShinyDresseur>
   */
  public function getBoiteShinyDresseurs(): Collection
  {
    return $this->boiteShinyDresseurs;
  }

  public function addBoiteShinyDresseur(BoiteShinyDresseur $boiteShinyDresseur): static
  {
    if (!$this->boiteShinyDresseurs->contains($boiteShinyDresseur)) {
      $this->boiteShinyDresseurs->add($boiteShinyDresseur);
      $boiteShinyDresseur->setBoiteShiny($this);
    }

    return $this;
  }

  public function removeBoiteShinyDresseur(BoiteShinyDresseur $boiteShinyDresseur): static
  {
    if ($this->boiteShinyDresseurs->removeElement($boiteShinyDresseur)) {
      // set the owning side to null (unless already changed)
      if ($boiteShinyDresseur->getBoiteShiny() === $this) {
        $boiteShinyDresseur->setBoiteShiny(null);
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
      $boiteShinyNature->setBoiteShiny($this);
    }

    return $this;
}

  public function removeBoiteShinyNature(BoiteShinyNature $boiteShinyNature): static
  {
    if ($this->boiteShinyNatures->removeElement($boiteShinyNature)) {
      // set the owning side to null (unless already changed)
      if ($boiteShinyNature->getBoiteShiny() === $this) {
        $boiteShinyNature->setBoiteShiny(null);
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
      $boiteShinyPokeball->setBoiteShiny($this);
    }

    return $this;
  }

  public function removeBoiteShinyPokeball(BoiteShinyPokeball $boiteShinyPokeball): static
  {
    if ($this->boiteShinyPokeballs->removeElement($boiteShinyPokeball)) {
      // set the owning side to null (unless already changed)
      if ($boiteShinyPokeball->getBoiteShiny() === $this) {
        $boiteShinyPokeball->setBoiteShiny(null);
      }
    }

    return $this;
  }

  /**
   * @return Collection<int, BoiteShinyGenre>
   */
  public function getBoiteShinyGenres(): Collection
  {
    return $this->boiteShinyGenres;
  }

  public function addBoiteShinyGenre(BoiteShinyGenre $boiteShinyGenre): static
  {
    if (!$this->boiteShinyGenres->contains($boiteShinyGenre)) {
      $this->boiteShinyGenres->add($boiteShinyGenre);
      $boiteShinyGenre->setBoiteShiny($this);
    }

    return $this;
  }

  public function removeBoiteShinyGenre(BoiteShinyGenre $boiteShinyGenre): static
  {
    if ($this->boiteShinyGenres->removeElement($boiteShinyGenre)) {
      // set the owning side to null (unless already changed)
      if ($boiteShinyGenre->getBoiteShiny() === $this) {
        $boiteShinyGenre->setBoiteShiny(null);
      }
    }

    return $this;
  }

  /**
   * @return Collection<int, BoiteShinyType>
   */
  public function getBoiteShinyTypes(): Collection
  {
    return $this->boiteShinyTypes;
  }

  public function addBoiteShinyType(BoiteShinyType $boiteShinyType): static
  {
    if (!$this->boiteShinyTypes->contains($boiteShinyType)) {
      $this->boiteShinyTypes->add($boiteShinyType);
      $boiteShinyType->setBoiteShiny($this);
    }

    return $this;
  }

  public function removeBoiteShinyType(BoiteShinyType $boiteShinyType): static
  {
    if ($this->boiteShinyTypes->removeElement($boiteShinyType)) {
      // set the owning side to null (unless already changed)
      if ($boiteShinyType->getBoiteShiny() === $this) {
        $boiteShinyType->setBoiteShiny(null);
      }
    }

    return $this;
  }
}
