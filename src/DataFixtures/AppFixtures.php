<?php

namespace App\DataFixtures;

use App\Tests\Factory\AdventureFactory;
use App\Tests\Factory\AdventureSheetFactory;
use App\Tests\Factory\BookFactory;
use App\Tests\Factory\ChapterFactory;
use App\Tests\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'email' => 'kevin@admin.com',
            'roles' => ['ROLE_ADMIN'],
        ]);

        UserFactory::createOne([
            'email' => 'kevin@user.com',
        ]);

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
            'chapter' => ChapterFactory::last(),
            'player' => UserFactory::find(['email' => 'kevin@admin.com']),
        ]);

        $manager->flush();
    }
}
