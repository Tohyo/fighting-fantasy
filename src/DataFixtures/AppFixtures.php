<?php

namespace App\DataFixtures;

use App\Factory\AdventureSheetFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        AdventureSheetFactory::createMany(10);

        $manager->flush();
    }
}
