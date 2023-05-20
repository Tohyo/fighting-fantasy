<?php

namespace App\Twig\Components;

use App\Entity\AdventureSheet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('skill')]
final class SkillComponent
{
    use DefaultActionTrait;

    #[LiveProp()]
    public AdventureSheet $adventureSheet;

    #[LiveAction]
    public function saveSkill(
        EntityManagerInterface $em,
        #[LiveArg] string $direction = 'up'
    ): void {
        if ($direction === 'up') {
            $this->adventureSheet->addSkill();
        } else {
            $this->adventureSheet->removeSkill();
        }

        $em->flush();
    }
}
