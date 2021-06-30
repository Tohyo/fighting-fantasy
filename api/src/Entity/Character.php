<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidV4Generator;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity()]
class Character
{
  #[ORM\Id]
  #[ORM\Column(type: 'uuid', unique: true)]
  #[ORM\GeneratedValue(strategy: 'CUSTOM')]
  #[ORM\CustomIdGenerator(class: UuidV4Generator::class)]
  #[Groups(['adventures'])]
  private string $id;

  #[ORM\Column(type: "integer")]
  #[Groups(['adventures'])]
  private int $initialDexterity;

  #[ORM\Column(type: "integer")]
  #[Groups(['adventures'])]
  private int $initialStamina;

  #[ORM\Column(type: "integer")]
  #[Groups(['adventures'])]
  private int $initialLuck;

  #[ORM\Column(type: "integer")]
  #[Groups(['adventures'])]
  private int $dexterity;

  #[ORM\Column(type: "integer")]
  #[Groups(['adventures'])]
  private int $stamina;

  #[ORM\Column(type: "integer")]
  #[Groups(['adventures'])]
  private int $luck;

  public function __construct()
  {
    $this->dexterity = $this->initialDexterity = 6 + random_int(1, 6);
    $this->stamina = $this->initialStamina = 12 + random_int(2, 12);
    $this->luck = $this->initialLuck = 6 + random_int(1, 6);
  }

  /**
   * Get the value of id
   *
   * @return string
   */
  public function getId() : string
  {
    return $this->id;
  }

  /**
   * Get the value of initialDexterity
   *
   * @return int
   */
  public function getInitialDexterity() : int
  {
    return $this->initialDexterity;
  }

  /**
   * Set the value of initialDexterity
   *
   * @param int $initialDexterity
   *
   * @return self
   */
  public function setInitialDexterity(int $initialDexterity) : self
  {
    $this->initialDexterity = $initialDexterity;

    return $this;
  }

  /**
   * Get the value of initialStamina
   *
   * @return int
   */
  public function getInitialStamina() : int
  {
    return $this->initialStamina;
  }

  /**
   * Set the value of initialStamina
   *
   * @param int $initialStamina
   *
   * @return self
   */
  public function setInitialStamina(int $initialStamina) : self
  {
    $this->initialStamina = $initialStamina;

    return $this;
  }

  /**
   * Get the value of initialLuck
   *
   * @return int
   */
  public function getInitialLuck() : int
  {
    return $this->initialLuck;
  }

  /**
   * Set the value of initialLuck
   *
   * @param int $initialLuck
   *
   * @return self
   */
  public function setInitialLuck(int $initialLuck) : self
  {
    $this->initialLuck = $initialLuck;

    return $this;
  }

  /**
   * Get the value of dexterity
   *
   * @return int
   */
  public function getDexterity() : int
  {
    return $this->dexterity;
  }

  /**
   * Set the value of dexterity
   *
   * @param int $dexterity
   *
   * @return self
   */
  public function setDexterity(int $dexterity) : self
  {
    $this->dexterity = $dexterity;

    return $this;
  }

  /**
   * Get the value of stamina
   *
   * @return int
   */
  public function getStamina() : int
  {
    return $this->stamina;
  }

  /**
   * Set the value of stamina
   *
   * @param int $stamina
   *
   * @return self
   */
  public function setStamina(int $stamina) : self
  {
    $this->stamina = $stamina;

    return $this;
  }

  /**
   * Get the value of luck
   *
   * @return int
   */
  public function getLuck() : int
  {
    return $this->luck;
  }

  /**
   * Set the value of luck
   *
   * @param int $luck
   *
   * @return self
   */
  public function setLuck(int $luck) : self
  {
    $this->luck = $luck;

    return $this;
  }
}
