<?php

namespace App\Factory;

use App\Entity\AdventureSheet;

class AdventureSheetFactory
{
    public function create(): AdventureSheet
    {
        $skill = random_int(7, 12);
        $stamina = random_int(14, 24);
        $luck = random_int(7, 12);

        return (new AdventureSheet())
            ->setSkill($skill)
            ->setStamina($stamina)
            ->setLuck($luck)
            ->setInitialSkill($skill)
            ->setInitialStamina($stamina)
            ->setInitialLuck($luck)
            ->setInventory([]);
    }
}
