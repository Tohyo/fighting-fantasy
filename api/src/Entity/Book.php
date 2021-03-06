<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidV4Generator;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity()]
class Book
{
  #[ORM\Id]
  #[ORM\Column(type: 'uuid', unique: true)]
  #[ORM\GeneratedValue(strategy: 'CUSTOM')]
  #[ORM\CustomIdGenerator(class: UuidV4Generator::class)]
  #[Groups(['books', 'adventures'])]
  private string $id;

  #[ORM\Column(type: "string", length: 255)]
  #[Groups(['books', 'adventures'])]
  private string $title;

  #[ORM\Column(type: "string", length: 255)]
  #[Groups(['books', 'adventures'])]
  private string $slug;

  #[ORM\OneToOne(targetEntity: Inventory::class, cascade: ["persist"])]
  private Inventory $startingInventory;

  #[ORM\OneToMany(targetEntity: Paragraph::class, mappedBy: "book")]
  #[Groups(['books', 'all_paragraphs'])]
  private Collection $paragraphs;

  #[ORM\OneToMany(targetEntity: Adventure::class, mappedBy: "paragraph")]
  private Collection $adventures;

  public function __construct()
  {
    $this->paragraphs = new ArrayCollection();
  }

  public function getId(): string
  {
    return $this->id;
  }

  public function setTitle(string $title): self
  {
    $this->title = $title;

    return $this;
  }

  public function getTitle(): string
  {
    return $this->title;
  }

  public function setSlug(string $slug): self
  {
    $this->slug = $slug;

    return $this;
  }

  public function getSlug(): string
  {
    return $this->slug;
  }

  public function setParagraphs(array $paragraphs): self
  {
    $this->paragraphs = $paragraphs;

    return $this;
  }

  public function getParagraphs(): Collection
  {
    return $this->paragraphs;
  }

  /**
   * Get the value of adventures
   *
   * @return Collection
   */
  public function getAdventures() : Collection
  {
    return $this->adventures;
  }

  /**
   * Set the value of adventures
   *
   * @param Collection $adventures
   *
   * @return self
   */
  public function setAdventures(Collection $adventures) : self
  {
    $this->adventures = $adventures;

    return $this;
  }

  /**
   * Get the value of startingInventory
   *
   * @return Inventory
   */
  public function getStartingInventory(): Inventory
  {
    return $this->startingInventory;
  }

  /**
   * Set the value of startingInventory
   *
   * @param Inventory $startingInventory
   *
   * @return self
   */
  public function setStartingInventory(Inventory $startingInventory): self
  {
    $this->startingInventory = $startingInventory;

    return $this;
  }
}
