<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Encounter;
use App\Entity\Inventory;
use App\Entity\Item;
use App\Entity\LinkedParagraph;
use App\Entity\Paragraph;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
  private UserPasswordEncoderInterface $userPasswordEncoder;

  public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
  {
    $this->userPasswordEncoder = $userPasswordEncoder;
  }

  public function load(ObjectManager $manager)
  {
    $user = (new User())
      ->setUsername('tohyo')
      ->setRoles([User::ROLE_ADMIN]);

    $user->setPassword($this->userPasswordEncoder->encodePassword($user, 'kevin'));

    $item = (new Item())
      ->setName('Or')
      ->setQuantity('20');

    $inventory = (new Inventory())
      ->addItem($item);

    $item->setInventory($inventory);

    $item1 = (new Item())
      ->setName('Or')
      ->setQuantity('200');

    $inventory1 = (new Inventory())
      ->addItem($item);

    $item1->setInventory($inventory1);

    $book = (new Book())
      ->setTitle('Le sorcier de la montagne de feu')
      ->setSlug('le-sorcier-de-la-montagne-de-feu')
      ->setStartingInventory($inventory);

    $book2 = (new Book())
      ->setTitle('La citadelle du chaos')
      ->setSlug('la-citadelle-du-chaos')
      ->setStartingInventory($inventory1);

    $paragraph2 = (new Paragraph())
      ->setNumber(2)
      ->setBook($book)
      ->setText('super paragraph2');

    $paragraph3 = (new Paragraph())
      ->setNumber(1)
      ->setBook($book2)
      ->setText('la citadelle du chaos paragraph1');

    $linkedParagraph = (new LinkedParagraph())
      ->setType(LinkedParagraph::LINK)
      ->setText('content')
      ->setNumber(2);

    $paragraph = (new Paragraph())
      ->setNumber(1)
      ->setText('paragraph 1 <a class="link-paragraph">content</a>')
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
    $manager->persist($book2);
    $manager->persist($paragraph3);
    $manager->persist($linkedParagraph);
    $manager->persist($paragraph);
    $manager->persist($encounter);
    $manager->persist($user);

    $manager->flush();
  }
}
