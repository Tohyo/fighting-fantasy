<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Encounter;
use App\Entity\Inventory;
use App\Entity\Item;
use App\Entity\LinkedParagraph;
use App\Entity\Paragraph;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {
    $book = (new Book())
      ->setTitle('Le sorcier de la montagne de feu')
      ->setSlug('le-sorcier-de-la-montagne-de-feu');

    $paragraph2 = (new Paragraph())
      ->setNumber(2)
      ->setBook($book)
      ->setText('super paragraph2');

    $linkedParagraph = (new LinkedParagraph())
      ->setType(LinkedParagraph::LINK)
      ->setText('content')
      ->setNumber(2);

    $paragraph = (new Paragraph())
      ->setNumber(1)
      ->setText('paragraph 1 content')
      ->addLinkedParagraph($linkedParagraph)
      ->setBook($book);

    $encounter = (new Encounter())
      ->setName('Troll')
      ->setDexterity(12)
      ->setToughness(12)
      ->setParagraph($paragraph2);

    $linkedParagraph->setParagraph($paragraph);

    $manager->persist($book);
    $manager->persist($paragraph2);
    $manager->persist($linkedParagraph);
    $manager->persist($paragraph);
    $manager->persist($encounter);

    $manager->flush();
  }
}
