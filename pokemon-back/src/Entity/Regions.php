<?php

namespace App\Entity;

use App\Repository\RegionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegionsRepository::class)]
class Regions
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $nomRegion = null;

  /**
   * @var Collection<int, PokemonShiny>
   */
  #[ORM\OneToMany(targetEntity: PokemonShiny::class, mappedBy: 'region')]
  private Collection $shinyList;

  public function __construct()
  {
      $this->shinyList = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getNomRegion(): ?string
  {
    return $this->nomRegion;
  }

  public function setNomRegion(string $nomRegion): static
  {
    $this->nomRegion = $nomRegion;

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
      $shinyList->setRegion($this);
    }

    return $this;
  }

  public function removeShinyList(PokemonShiny $shinyList): static
  {
    if ($this->shinyList->removeElement($shinyList)) {
      // set the owning side to null (unless already changed)
      if ($shinyList->getRegion() === $this) {
        $shinyList->setRegion(null);
      }
    }

    return $this;
  }
}
