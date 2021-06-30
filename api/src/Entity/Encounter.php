<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidV4Generator;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity()]
class Encounter
{
  #[ORM\Id]
  #[ORM\Column(type: 'uuid', unique: true)]
  #[ORM\GeneratedValue(strategy: 'CUSTOM')]
  #[ORM\CustomIdGenerator(class: UuidV4Generator::class)]
  private string $id;

  #[ORM\Column(type: "string", length: 255)]
  #[Groups(['paragraphs', 'adventures'])]
  public string $name;

  #[ORM\Column(type: "integer")]
  #[Groups(['paragraphs', 'adventures'])]
  public int $dexterity;

  #[ORM\Column(type: "integer")]
  #[Groups(['paragraphs', 'adventures'])]
  public int $toughness;

  #[ORM\ManyToOne(targetEntity: Paragraph::class, inversedBy: "encounters")]
  public Paragraph $paragraph;

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
   * Get the value of name
   *
   * @return string
   */
  public function getName() : string
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
  public function setName(string $name) : self
  {
    $this->name = $name;

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
   * Get the value of toughness
   *
   * @return int
   */
  public function getToughness() : int
  {
    return $this->toughness;
  }

  /**
   * Set the value of toughness
   *
   * @param int $toughness
   *
   * @return self
   */
  public function setToughness(int $toughness) : self
  {
    $this->toughness = $toughness;

    return $this;
  }

  /**
   * Get the value of paragraph
   *
   * @return Paragraph
   */
  public function getParagraph() : Paragraph
  {
    return $this->paragraph;
  }

  /**
   * Set the value of paragraph
   *
   * @param Paragraph $paragraph
   *
   * @return self
   */
  public function setParagraph(Paragraph $paragraph) : self
  {
    $this->paragraph = $paragraph;

    return $this;
  }
}
