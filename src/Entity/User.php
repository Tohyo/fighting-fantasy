<?php

namespace App\Entity;

use App\Enum\AdventureStatusEnum;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    /** @var array<string> $roles */
    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    private ?string $plainPassword = null;

    /** @var Collection<int, Adventure> $adventures */
    #[ORM\OneToMany(mappedBy: 'player', targetEntity: Adventure::class, orphanRemoval: true)]
    private Collection $adventures;

    /** @var Collection<int, Book> $books */
    #[ORM\OneToMany(mappedBy: 'creator', targetEntity: Book::class, orphanRemoval: true)]
    private Collection $books;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastname = null;

    public function __construct()
    {
        $this->adventures = new ArrayCollection();
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /** @param array<string> $roles */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @return Collection<int, Adventure>
     */
    public function getAdventures(): Collection
    {
        return $this->adventures;
    }

    public function addAdventure(Adventure $adventure): self
    {
        if (!$this->adventures->contains($adventure)) {
            $this->adventures->add($adventure);
            $adventure->setPlayer($this);
        }

        return $this;
    }

    public function removeAdventure(Adventure $adventure): self
    {
        if ($this->adventures->removeElement($adventure)) {
            // set the owning side to null (unless already changed)
            if ($adventure->getPlayer() === $this) {
                $adventure->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
            $book->setCreator($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getCreator() === $this) {
                $book->setCreator(null);
            }
        }

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFullname(): string
    {
        if ($this->firstname === null && $this->lastname === null) {
            return '';
        }

        return trim(sprintf('%s %s', $this->firstname, $this->lastname));
    }

    /**
     * @return Adventure[]
     */
    public function getActiveAdventures(): array
    {
        $adventures = [];

        foreach ($this->adventures as $adventure) {
            if ($adventure->book->published && $adventure->status === AdventureStatusEnum::ACTIVE->value) {
                $adventures[] = $adventure;
            }
        }

        return $adventures;
    }
}
