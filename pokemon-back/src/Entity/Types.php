<?php

namespace App\Entity;

use App\Repository\TypesRepository;
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
}
