<?php

namespace App\Entity;

use App\Repository\RegionDresseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegionDresseurRepository::class)]
class RegionDresseur
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $nomRegionDresseur = null;

  /**
   * @var Collection<int, Dresseurs>
   */
  #[ORM\OneToMany(targetEntity: Dresseurs::class, mappedBy: 'regionDresseur')]
  private Collection $dresseurs;

  public function __construct()
  {
    $this->dresseurs = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getNomRegionDresseur(): ?string
  {
    return $this->nomRegionDresseur;
  }

  public function setNomRegionDresseur(string $nomRegionDresseur): static
  {
    $this->nomRegionDresseur = $nomRegionDresseur;

    return $this;
  }

  /**
   * @return Collection<int, Dresseurs>
   */
  public function getDresseurs(): Collection
  {
    return $this->dresseurs;
  }

  public function addDresseur(Dresseurs $dresseur): static
  {
    if (!$this->dresseurs->contains($dresseur)) {
      $this->dresseurs->add($dresseur);
      $dresseur->setRegionDresseur($this);
    }

    return $this;
  }

  public function removeDresseur(Dresseurs $dresseur): static
  {
    if ($this->dresseurs->removeElement($dresseur)) {
      // set the owning side to null (unless already changed)
      if ($dresseur->getRegionDresseur() === $this) {
        $dresseur->setRegionDresseur(null);
      }
    }

    return $this;
  }
}
