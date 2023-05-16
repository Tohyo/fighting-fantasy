<?php

namespace App\DataFixtures;

use App\Factory\AdventureFactory;
use App\Factory\AdventureSheetFactory;
use App\Factory\BookFactory;
use App\Factory\ChapterFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        BookFactory::createOne();

        ChapterFactory::createOne(['book' => BookFactory::last()]);
        $chapter = ChapterFactory::random();
        ChapterFactory::createMany(4, [
            'book' => BookFactory::last(),
            'content' => ChapterFactory::faker()->text(100) .  ' [#'.$chapter->object()->getId().']rendez-vous au chapitre[#]',
        ]);

        AdventureFactory::createOne([
            'adventureSheet' => AdventureSheetFactory::createOne(),
            'book' => BookFactory::last(),
            'chapter' => ChapterFactory::last()
        ]);
        
        $manager->flush();
    }
}
