<?php

namespace App\Entity;

use App\Repository\ChapterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChapterRepository::class)]
class Chapter
{
    #[ORM\Id]
    #[ORM\Column(type: Types::GUID)]
    public readonly string $id;

    #[ORM\Column(type: Types::TEXT)]
    public string $content;

    #[ORM\ManyToOne(inversedBy: 'chapters')]
    #[ORM\JoinColumn(nullable: false)]
    public Book $book;

    #[ORM\Column]
    public int $number;

    public function __construct()
    {
        $this->id = uuid_create(UUID_TYPE_RANDOM);
    }
}
