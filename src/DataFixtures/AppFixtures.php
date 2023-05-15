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
        BookFactory::createMany(1, [
            'chapters' => ChapterFactory::new()->many(4),
        ]);

        AdventureFactory::createOne([
            'adventureSheet' => AdventureSheetFactory::createOne()
        ]);
        
        $manager->flush();
    }
}
