<?php

namespace App\Tests\E2E;

use Symfony\Component\Panther\PantherTestCase;

class BookTest extends PantherTestCase
{
    public function testSomething(): void
    {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/');

        $this->assertSelectorTextContains('h1', 'Fighting-Fantasy');
    }
}
