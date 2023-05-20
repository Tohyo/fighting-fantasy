<?php

namespace App\Components;

use App\Entity\AdventureSheet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class LuckComponent
{
    use DefaultActionTrait;

    #[LiveProp]
    public AdventureSheet $adventureSheet;

    #[LiveAction]
    public function saveLuck(
        EntityManagerInterface $em,
        #[LiveArg] string $direction = 'up'
    ): void {
        if ($direction === 'up') {
            $this->adventureSheet->addLuck();
        } else {
            $this->adventureSheet->removeLuck();
        }

        $em->flush();
    }
}
