<?php

namespace App\Entity;

use App\Repository\BookRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Slug;
use Gedmo\Mapping\Annotation\Timestampable;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ORM\Index(columns: ['slug'], flags: ['fulltext'])]
class Book
{
    #[ORM\Id]
    #[ORM\Column(type: Types::GUID)]
    public readonly string $id;

    #[ORM\Column(length: 255)]
    public string $title;

    #[ORM\Column(type: Types::TEXT)]
    public string $description;

    #[ORM\Column(length: 255)]
    #[Slug(fields: ['title'])]
    public string $slug;

    /** @var Collection<int, Chapter> $chapters */
    #[ORM\OneToMany(mappedBy: 'book', targetEntity: Chapter::class)]
    public Collection $chapters;

    /** @var Collection<int, Adventure> $adventures */
    #[ORM\OneToMany(mappedBy: 'book', targetEntity: Adventure::class, orphanRemoval: true)]
    public Collection $adventures;

    #[ORM\ManyToOne(inversedBy: 'books')]
    #[ORM\JoinColumn(nullable: false)]
    public User $creator;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Timestampable(on: "create")]
    public DateTime $createdAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Timestampable(on: "create")]
    public DateTime $updatedAt;

    #[ORM\Column]
    public bool $published = false;

    public function __construct()
    {
        $this->id = uuid_create(UUID_TYPE_RANDOM);
        $this->chapters = new ArrayCollection();
        $this->adventures = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->title;
    }
}
