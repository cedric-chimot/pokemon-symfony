<?php

namespace App\Entity;

use App\Repository\AttaquesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

  /**
   * @var Collection<int, PokemonShiny>
   */
  #[ORM\OneToMany(targetEntity: PokemonShiny::class, mappedBy: 'attaque1')]
  private Collection $pokemonShiniesAttaque1;

  /**
   * @var Collection<int, PokemonShiny>
   */
  #[ORM\OneToMany(targetEntity: PokemonShiny::class, mappedBy: 'attaque2')]
  private Collection $pokemonShiniesAttaque2;

  /**
   * @var Collection<int, PokemonShiny>
   */
  #[ORM\OneToMany(targetEntity: PokemonShiny::class, mappedBy: 'attaque3')]
  private Collection $pokemonShiniesAttaque3;

  /**
   * @var Collection<int, PokemonShiny>
   */
  #[ORM\OneToMany(targetEntity: PokemonShiny::class, mappedBy: 'attaque4')]
  private Collection $pokemonShiniesAttaque4;

  public function __construct()
  {
      $this->pokemonShiniesAttaque1 = new ArrayCollection();
      $this->pokemonShiniesAttaque2 = new ArrayCollection();
      $this->pokemonShiniesAttaque3 = new ArrayCollection();
      $this->pokemonShiniesAttaque4 = new ArrayCollection();
  }

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

  /**
   * @return Collection<int, PokemonShiny>
   */
  public function getPokemonShiniesAttaque1(): Collection
  {
      return $this->pokemonShiniesAttaque1;
  }

  public function addPokemonShiniesAttaque1(PokemonShiny $pokemonShiniesAttaque1): static
  {
      if (!$this->pokemonShiniesAttaque1->contains($pokemonShiniesAttaque1)) {
          $this->pokemonShiniesAttaque1->add($pokemonShiniesAttaque1);
          $pokemonShiniesAttaque1->setAttaque1($this);
      }

      return $this;
  }

  public function removePokemonShiniesAttaque1(PokemonShiny $pokemonShiniesAttaque1): static
  {
      if ($this->pokemonShiniesAttaque1->removeElement($pokemonShiniesAttaque1)) {
          // set the owning side to null (unless already changed)
          if ($pokemonShiniesAttaque1->getAttaque1() === $this) {
              $pokemonShiniesAttaque1->setAttaque1(null);
          }
      }

      return $this;
  }

  /**
   * @return Collection<int, PokemonShiny>
   */
  public function getPokemonShiniesAttaque2(): Collection
  {
      return $this->pokemonShiniesAttaque2;
  }

  public function addPokemonShiniesAttaque2(PokemonShiny $pokemonShiniesAttaque2): static
  {
      if (!$this->pokemonShiniesAttaque2->contains($pokemonShiniesAttaque2)) {
          $this->pokemonShiniesAttaque2->add($pokemonShiniesAttaque2);
          $pokemonShiniesAttaque2->setAttaque2($this);
      }

      return $this;
  }

  public function removePokemonShiniesAttaque2(PokemonShiny $pokemonShiniesAttaque2): static
  {
      if ($this->pokemonShiniesAttaque2->removeElement($pokemonShiniesAttaque2)) {
          // set the owning side to null (unless already changed)
          if ($pokemonShiniesAttaque2->getAttaque2() === $this) {
              $pokemonShiniesAttaque2->setAttaque2(null);
          }
      }

      return $this;
  }

  /**
   * @return Collection<int, PokemonShiny>
   */
  public function getPokemonShiniesAttaque3(): Collection
  {
      return $this->pokemonShiniesAttaque3;
  }

  public function addPokemonShiniesAttaque3(PokemonShiny $pokemonShiniesAttaque3): static
  {
      if (!$this->pokemonShiniesAttaque3->contains($pokemonShiniesAttaque3)) {
          $this->pokemonShiniesAttaque3->add($pokemonShiniesAttaque3);
          $pokemonShiniesAttaque3->setAttaque3($this);
      }

      return $this;
  }

  public function removePokemonShiniesAttaque3(PokemonShiny $pokemonShiniesAttaque3): static
  {
      if ($this->pokemonShiniesAttaque3->removeElement($pokemonShiniesAttaque3)) {
          // set the owning side to null (unless already changed)
          if ($pokemonShiniesAttaque3->getAttaque3() === $this) {
              $pokemonShiniesAttaque3->setAttaque3(null);
          }
      }

      return $this;
  }

  /**
   * @return Collection<int, PokemonShiny>
   */
  public function getPokemonShiniesAttaque4(): Collection
  {
      return $this->pokemonShiniesAttaque4;
  }

  public function addPokemonShiniesAttaque4(PokemonShiny $pokemonShiniesAttaque4): static
  {
      if (!$this->pokemonShiniesAttaque4->contains($pokemonShiniesAttaque4)) {
          $this->pokemonShiniesAttaque4->add($pokemonShiniesAttaque4);
          $pokemonShiniesAttaque4->setAttaque4($this);
      }

      return $this;
  }

  public function removePokemonShiniesAttaque4(PokemonShiny $pokemonShiniesAttaque4): static
  {
      if ($this->pokemonShiniesAttaque4->removeElement($pokemonShiniesAttaque4)) {
          // set the owning side to null (unless already changed)
          if ($pokemonShiniesAttaque4->getAttaque4() === $this) {
              $pokemonShiniesAttaque4->setAttaque4(null);
          }
      }

      return $this;
  }
}
