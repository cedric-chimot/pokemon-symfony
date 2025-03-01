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

  public function __construct()
  {
    $this->attaques = new ArrayCollection();
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
}
