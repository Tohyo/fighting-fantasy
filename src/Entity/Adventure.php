<?php

namespace App\Entity;

use App\Repository\AdventureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdventureRepository::class)]
class Adventure
{
    #[ORM\Id]
    #[ORM\Column(type: Types::GUID)]
    public readonly string $id;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    public Chapter $chapter;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    public ?AdventureSheet $adventureSheet = null;

    #[ORM\ManyToOne(inversedBy: 'adventures')]
    #[ORM\JoinColumn(nullable: false)]
    public Book $book;

    #[ORM\ManyToOne(inversedBy: 'adventures')]
    #[ORM\JoinColumn(nullable: false)]
    public ?User $player = null;

    public function __construct()
    {
        $this->id = uuid_create(UUID_TYPE_RANDOM);
    }
}
