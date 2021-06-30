<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\IdGenerator\UuidV4Generator;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity()]
#[ORM\Table(name: "`users`")]
class User implements UserInterface
{
  public const ROLE_USER = 'ROLE_USER';
  public const ROLE_ADMIN = 'ROLE_ADMIN';

  #[ORM\Id]
  #[ORM\Column(type: 'uuid', unique: true)]
  #[ORM\GeneratedValue(strategy: 'CUSTOM')]
  #[ORM\CustomIdGenerator(class: UuidV4Generator::class)]
  #[Groups(['users'])]
  private $id;

  #[ORM\Column(type: "string", length: 180, unique: true)]
  #[Groups(['users'])]
  private $username;

  #[ORM\Column(type: "json")]
  #[Groups(['users'])]
  private $roles = [];

  #[ORM\OneToMany(targetEntity: Adventure::class, mappedBy: "user")]
  #[Groups(['users'])]
  private Collection $adventures;

  #[ORM\Column(type: "string")]
  private $password;

  public function __construct()
  {
    $this->adventures = new ArrayCollection();
  }

  public function getId(): string
  {
    return $this->id;
  }

  /**
   * A visual identifier that represents this user.
   *
   * @see UserInterface
   */
  public function getUsername(): string
  {
    return (string) $this->username;
  }

  /**
   * @see UserInterface
   */
  public function getRoles(): array
  {
    $roles = $this->roles;
    // guarantee every user at least has ROLE_USER
    $roles[] = self::ROLE_USER;

    return array_unique($roles);
  }

  public function setRoles(array $roles): self
  {
    $this->roles = $roles;

    return $this;
  }

  /**
   * @see UserInterface
   */
  public function getPassword(): string
  {
    return (string) $this->password;
  }

  public function setPassword(string $password): self
  {
    $this->password = $password;

    return $this;
  }

  /**
   * Returning a salt is only needed, if you are not using a modern
   * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
   *
   * @see UserInterface
   */
  public function getSalt(): ?string
  {
    return null;
  }

  /**
   * @see UserInterface
   */
  public function eraseCredentials()
  {
      // If you store any temporary, sensitive data on the user, clear it here
      // $this->plainPassword = null;
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
   * Set the value of username
   */
  public function setUsername($username): self
  {
    $this->username = $username;

    return $this;
  }
}
