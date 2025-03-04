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

  public function __construct()
  {
    $this->shinyList = new ArrayCollection();
    $this->boiteShinyDresseurs = new ArrayCollection();
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
}
