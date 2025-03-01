<?php

namespace App\Entity;

use App\Repository\AttaquesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttaquesRepository::class)]
class Attaques
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $nomAttaque = null;

  #[ORM\ManyToOne(inversedBy: 'attaques')]
  #[ORM\JoinColumn(nullable: false)]
  private ?Types $type = null;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getNomAttaque(): ?string
  {
    return $this->nomAttaque;
  }

  public function setNomAttaque(string $nomAttaque): static
  {
    $this->nomAttaque = $nomAttaque;

    return $this;
  }

  public function getType(): ?Types
  {
    return $this->type;
  }

  public function setType(?Types $type): static
  {
    $this->type = $type;

    return $this;
  }
}
