<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidV4Generator;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 */
class Adventure
{
  /**
   * @ORM\Id
   * @ORM\Column(type="uuid", unique=true)
   * @ORM\GeneratedValue(strategy="CUSTOM")
   * @ORM\CustomIdGenerator(class=UuidV4Generator::class)
   */
  #[Groups(['adventures'])]
  private string $id;

  /**
   * @ORM\ManyToOne(targetEntity="Book", inversedBy="adventures", fetch="EAGER")
   */
  #[Groups(['adventures'])]
  private Book $book;

  /**
   * @ORM\ManyToOne(targetEntity="Paragraph", inversedBy="adventures", fetch="EAGER")
   */
  #[Groups(['adventures'])]
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
   * Get the value of book
   *
   * @return Book
   */
  public function getBook() : Book
  {
    return $this->book;
  }

  /**
   * Set the value of book
   *
   * @param Book $book
   *
   * @return self
   */
  public function setBook(Book $book) : self
  {
    $this->book = $book;

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
