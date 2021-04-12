<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidV4Generator;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 */
class LinkedParagraph
{
  public const LINK = 'link';
  public const INPUT = 'input';

  /**
   * @ORM\Id
   * @ORM\Column(type="uuid", unique=true)
   * @ORM\GeneratedValue(strategy="CUSTOM")
   * @ORM\CustomIdGenerator(class=UuidV4Generator::class)
   */
  private string $id;

  /**
   * @ORM\Column(type="string", length=255)
   */
  #[Groups(['paragraphs', 'adventures'])]
  private string $type;

  /**
   * @ORM\Column(type="string", length=255)
   */
  #[Groups(['paragraphs', 'adventures'])]
  private ?string $text;

  /**
   * @ORM\Column(type="integer")
   */
  #[Groups(['paragraphs', 'adventures'])]
  private int $number;

  /**
   * @ORM\ManyToOne(targetEntity="Paragraph", inversedBy="linkedParagraphs")
   */
  private Paragraph $paragraph;

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
   * Get the value of type
   *
   * @return string
   */
  public function getType() : string
  {
    return $this->type;
  }

  /**
   * Set the value of type
   *
   * @param string $type
   *
   * @return self
   */
  public function setType(string $type) : self
  {
    $this->type = $type;

    return $this;
  }

  /**
   * Get the value of text
   *
   * @return ?string
   */
  public function getText() : ?string
  {
    return $this->text;
  }

  /**
   * Set the value of text
   *
   * @param ?string $text
   *
   * @return self
   */
  public function setText(?string $text) : self
  {
    $this->text = $text;

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

  /**
   * Get the value of number
   *
   * @return int
   */
  public function getNumber() : int
  {
    return $this->number;
  }

  /**
   * Set the value of number
   *
   * @param int $number
   *
   * @return self
   */
  public function setNumber(int $number) : self
  {
    $this->number = $number;

    return $this;
  }
}
