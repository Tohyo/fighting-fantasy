<?php

namespace App\Components;

use App\Entity\AdventureSheet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class AdventureSheetComponent
{
    use DefaultActionTrait;

    #[LiveProp]
    public AdventureSheet $adventureSheet;

    public function __construct(
        private EntityManagerInterface $entityManagerInterface
    ) {}

    #[LiveAction]
    public function addLuck(): void
    {
        $this->adventureSheet->setLuck($this->adventureSheet->getLuck() + 1);

        $this->entityManagerInterface->flush();
    }
}
