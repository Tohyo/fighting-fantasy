<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidV4Generator;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 */
class Paragraph
{
  /**
   * @ORM\Id
   * @ORM\Column(type="uuid", unique=true)
   * @ORM\GeneratedValue(strategy="CUSTOM")
   * @ORM\CustomIdGenerator(class=UuidV4Generator::class)
   */
  #[Groups(['paragraphs', 'adventures'])]
  private string $id;

  /**
   * @ORM\Column(type="integer")
   */
  #[Groups(['paragraphs', 'adventures'])]
  private int $number;

  /**
   * @ORM\Column(type="text")
   */
  #[Groups(['paragraphs', 'adventures'])]
  private string $text;

  /**
   * @ORM\OneToMany(targetEntity="Encounter", mappedBy="paragraph")
   */
  #[Groups(['paragraphs', 'adventures'])]
  private Collection $encounters;

  /**
   * @ORM\OneToMany(targetEntity="LinkedParagraph", mappedBy="paragraph")
   */
  #[Groups(['paragraphs', 'adventures'])]
  private Collection $linkedParagraphs;

  /**
   * @ORM\ManyToOne(targetEntity="Book", inversedBy="paragraphs")
   */
  private Book $book;

  /**
   * @ORM\OneToMany(targetEntity="Adventure", mappedBy="paragraph")
   */
  private Collection $adventures;

  public function __construct()
  {
    $this->encounters =  new ArrayCollection();
    $this->linkedParagraphs = new ArrayCollection();
  }

  public function getId(): string
  {
    return $this->id;
  }

  public function setNumber(int $number): self
  {
    $this->number = $number;

    return $this;
  }

  #[Groups(['adventures'])]
  public function getNumber(): int
  {
    return $this->number;
  }

  /**
   * Get the value of encounters
   *
   * @return Collection
   */
  public function getEncounters() : Collection
  {
    return $this->encounters;
  }

  /**
   * Set the value of encounters
   *
   * @param Collection $encounters
   *
   * @return self
   */
  public function setEncounters(Collection $encounters) : self
  {
    $this->encounters = $encounters;

    return $this;
  }

  /**
   * Get the value of linkedParagraphs
   *
   * @return Collection
   */
  public function getLinkedParagraphs() : Collection
  {
    return $this->linkedParagraphs;
  }

  public function addLinkedParagraph(LinkedParagraph $linkedParagraph) : self
  {
    $this->linkedParagraphs[] = $linkedParagraph;

    return $this;
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
   * Get the value of text
   *
   * @return string
   */
  public function getText() : string
  {
    return $this->text;
  }

  /**
   * Set the value of text
   *
   * @param string $text
   *
   * @return self
   */
  public function setText(string $text) : self
  {
    $this->text = $text;

    return $this;
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
}
