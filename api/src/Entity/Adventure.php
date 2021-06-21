<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidV4Generator;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 */
class Adventure
{
  public const STATUS_IN_PROGRESS = 'in progress';
  public const STATUS_DONE = 'done';

  /**
   * @ORM\Id
   * @ORM\Column(type="uuid", unique=true)
   * @ORM\GeneratedValue(strategy="CUSTOM")
   * @ORM\CustomIdGenerator(class=UuidV4Generator::class)
   */
  #[Groups(['adventures', 'user_adventures'])]
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
   * @ORM\OneToOne(targetEntity="Character", cascade={"persist"})
   */
  #[Groups(['adventures'])]
  private Character $character;

  /**
   * @ORM\ManyToOne(targetEntity="User", inversedBy="adventures")
   */
  #[Groups(['adventures'])]
  private User $user;

  /**
   * @ORM\OneToOne(targetEntity="Inventory", cascade={"persist"})
   */
  #[Groups(['adventures'])]
  private Inventory $inventory;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private string $status = self::STATUS_IN_PROGRESS;

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

  /**
   * Get the value of character
   *
   * @return Character
   */
  public function getCharacter() : Character
  {
    return $this->character;
  }

  /**
   * Set the value of character
   *
   * @param Character $character
   *
   * @return self
   */
  public function setCharacter(Character $character) : self
  {
    $this->character = $character;

    return $this;
  }

  /**
   * Get the value of user
   *
   * @return User
   */
  public function getUser() : User
  {
    return $this->user;
  }

  /**
   * Set the value of user
   *
   * @param User $user
   *
   * @return self
   */
  public function setUser(User $user) : self
  {
    $this->user = $user;

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

  /**
   * Get the value of status
   *
   * @return string
   */
  public function getStatus(): string
  {
    return $this->status;
  }

  /**
   * Set the value of status
   *
   * @param string $status
   *
   * @return self
   */
  public function setStatus(string $status): self
  {
    $this->status = $status;

    return $this;
  }
}
