<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidV4Generator;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity()]
class Inventory
{
  #[ORM\Id]
  #[ORM\Column(type: 'uuid', unique: true)]
  #[ORM\GeneratedValue(strategy: 'CUSTOM')]
  #[ORM\CustomIdGenerator(class: UuidV4Generator::class)]
  private string $id;

  #[ORM\OneToMany(targetEntity: Item::class, mappedBy: "inventory", cascade: ["persist"])]
  #[Groups(['adventures'])]
  private Collection $items;

  public function __construct()
  {
    $this->items =  new ArrayCollection();
  }

  /**
   * Get the value of id
   *
   * @return string
   */
  public function getId(): string
  {
    return $this->id;
  }

  /**
   * Get the value of items
   *
   * @return Collection
   */
  public function getItems(): Collection
  {
    return $this->items;
  }

  /**
   * Set the value of items
   *
   * @param Collection $items
   *
   * @return self
   */
  public function setItems(Collection $items): self
  {
    $this->items = $items;

    return $this;
  }

  /**
   * @param Item $item
   *
   * @return self
   */
  public function addItem(Item $item): self
  {
    $this->items->add($item);

    return $this;
  }
}
