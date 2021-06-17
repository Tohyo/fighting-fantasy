<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidV4Generator;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 */
class Item
{
  /**
   * @ORM\Id
   * @ORM\Column(type="uuid", unique=true)
   * @ORM\GeneratedValue(strategy="CUSTOM")
   * @ORM\CustomIdGenerator(class=UuidV4Generator::class)
   */
  private string $id;

  /**
   * @ORM\Column(type="integer")
   */
  #[Groups(['adventures'])]
  private int $quantity;

  /**
   * @ORM\Column(type="string", length=255)
   */
  #[Groups(['adventures'])]
  private string $name;

  /**
   * @ORM\ManyToOne(targetEntity="Inventory", inversedBy="items")
   */
  public Inventory $inventory;

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
   * Get the value of quantity
   *
   * @return int
   */
  public function getQuantity(): int
  {
    return $this->quantity;
  }

  /**
   * Set the value of quantity
   *
   * @param int $quantity
   *
   * @return self
   */
  public function setQuantity(int $quantity): self
  {
    $this->quantity = $quantity;

    return $this;
  }

  /**
   * Get the value of name
   *
   * @return string
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * Set the value of name
   *
   * @param string $name
   *
   * @return self
   */
  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get the value of inventory
   *
   * @return Inventory
   */
  public function getInventory(): Inventory
  {
    return $this->inventory;
  }

  /**
   * Set the value of inventory
   *
   * @param Inventory $inventory
   *
   * @return self
   */
  public function setInventory(Inventory $inventory): self
  {
    $this->inventory = $inventory;

    return $this;
  }
}
