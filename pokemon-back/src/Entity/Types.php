<?php

namespace App\Entity;

use App\Repository\TypesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypesRepository::class)]
class Types
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $nomType = null;

  #[ORM\Column]
  private ?int $nbShiny = null;

  /**
   * @var Collection<int, Attaques>
   */
  #[ORM\OneToMany(targetEntity: Attaques::class, mappedBy: 'type')]
  private Collection $attaques;

  /**
   * @var Collection<int, PokemonShiny>
   */
  #[ORM\OneToMany(targetEntity: PokemonShiny::class, mappedBy: 'type1')]
  private Collection $shinyList;

  /**
   * @var Collection<int, PokemonShiny>
   */
  #[ORM\OneToMany(targetEntity: PokemonShiny::class, mappedBy: 'type2')]
  private Collection $shinyListType2;

  public function __construct()
  {
    $this->attaques = new ArrayCollection();
    $this->shinyList = new ArrayCollection();
    $this->shinyListType2 = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getNomType(): ?string
  {
    return $this->nomType;
  }

  public function setNomType(string $nomType): static
  {
    $this->nomType = $nomType;

    return $this;
  }

  public function getNbShiny(): ?int
  {
    return $this->nbShiny;
  }

  public function setNbShiny(int $nbShiny): static
  {
    $this->nbShiny = $nbShiny;

    return $this;
  }

  /**
   * @return Collection<int, Attaques>
   */
  public function getAttaques(): Collection
  {
    return $this->attaques;
  }

  public function addAttaque(Attaques $attaque): static
  {
    if (!$this->attaques->contains($attaque)) {
      $this->attaques->add($attaque);
      $attaque->setType($this);
    }

    return $this;
  }

  public function removeAttaque(Attaques $attaque): static
  {
    if ($this->attaques->removeElement($attaque)) {
      // set the owning side to null (unless already changed)
      if ($attaque->getType() === $this) {
        $attaque->setType(null);
      }
    }

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
      $shinyList->setType1($this);
    }

    return $this;
  }

  public function removeShinyList(PokemonShiny $shinyList): static
  {
    if ($this->shinyList->removeElement($shinyList)) {
      // set the owning side to null (unless already changed)
      if ($shinyList->getType1() === $this) {
        $shinyList->setType1(null);
      }
    }

    return $this;
  }

  /**
   * @return Collection<int, PokemonShiny>
   */
  public function getShinyListType2(): Collection
  {
    return $this->shinyListType2;
  }

  public function addShinyListType2(PokemonShiny $shinyListType2): static
  {
    if (!$this->shinyListType2->contains($shinyListType2)) {
      $this->shinyListType2->add($shinyListType2);
      $shinyListType2->setType2($this);
    }

    return $this;
  }

  public function removeShinyListType2(PokemonShiny $shinyListType2): static
  {
    if ($this->shinyListType2->removeElement($shinyListType2)) {
      // set the owning side to null (unless already changed)
      if ($shinyListType2->getType2() === $this) {
        $shinyListType2->setType2(null);
      }
    }

    return $this;
  }
}
