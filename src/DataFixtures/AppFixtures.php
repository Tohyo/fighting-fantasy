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

        BookFactory::createOne([
            'creator' => UserFactory::find(['email' => 'kevin@admin.com']),
        ]);

        ChapterFactory::createSequence(
            function() {
                foreach (range(1, 10) as $i) {
                    yield [
                        'book' => BookFactory::last(),
                        'content' => ChapterFactory::faker()->text(100) .  "[#".($i + 1)."]Rendez-vous au chapitre ".($i + 1)."[#]",
                        'number' => $i
                    ];
                }
            }
        );

        AdventureFactory::createOne([
            'adventureSheet' => AdventureSheetFactory::createOne(),
            'book' => BookFactory::last(),
            'chapter' => ChapterFactory::find(['number' => 1]),
            'player' => UserFactory::find(['email' => 'kevin@admin.com']),
        ]);

        $manager->flush();
    }
}
