<?php

namespace App\Serializer;

use App\Entity\Book;
use App\Entity\Paragraph;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;

class ParagraphSerializer extends Serializer
{
  private EntityManagerInterface $em;

  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;
  }

  public function denormalize($data, string $type, string $format = null, array $context = []): Paragraph
  {
    $book = $this->em->getRepository(Book::class)->find($data['book']['id']);

    $parapraph = (new Paragraph())
      ->setBook($book)
      ->setNumber($data['number'])
      ->setText($data['text']);

    return $parapraph;
  }

  public function supportsDenormalization($data, string $type, string $format = null, array $context = []): bool
  {
    return $type === Paragraph::class;
  }

  public function supportsEncoding(string $format, array $context = []): bool
  {
    return false;
  }

  public function supportsDecoding(string $format, array $context = []): bool
  {
    return false;
  }
}
