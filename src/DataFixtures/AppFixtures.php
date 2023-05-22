<?php

namespace App\DataFixtures;

use App\Factory\AdventureFactory;
use App\Factory\AdventureSheetFactory;
use App\Factory\BookFactory;
use App\Factory\ChapterFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        BookFactory::createMany(10);

        ChapterFactory::createOne(['book' => BookFactory::last()]);
        $chapter = ChapterFactory::random();
        ChapterFactory::createMany(4, [
            'book' => BookFactory::last(),
            'content' => ChapterFactory::faker()->text(100) .  ' [#'.$chapter->object()->getId().']Rendez-vous au chapitre 48[#]',
        ]);

        AdventureFactory::createOne([
            'adventureSheet' => AdventureSheetFactory::createOne(),
            'book' => BookFactory::last(),
            'chapter' => ChapterFactory::last()
        ]);

        UserFactory::createOne([
            'email' => 'kevin@admin.com',
            'roles' => ['ROLE_ADMIN'],
        ]);

        UserFactory::createOne([
            'email' => 'kevin@user.com',
        ]);

        $manager->flush();
    }
}
