<?php

namespace App\Entity;

use App\Repository\BoitesShinyRepository;
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
}
