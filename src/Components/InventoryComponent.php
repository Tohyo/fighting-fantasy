<?php

namespace App\Components;

use App\Entity\AdventureSheet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class InventoryComponent
{
    use DefaultActionTrait;

    #[LiveProp]
    public bool $isAdding = false;

    #[LiveProp(writable: true)]
    public ?string $newItem = null;

    #[LiveProp]
    public AdventureSheet $adventureSheet;

    #[LiveAction]
    public function addItem(): void
    {
        $this->isAdding = true;
    }

    #[LiveAction]
    public function save(EntityManagerInterface $em): void
    {
        $this->adventureSheet->addItem($this->newItem);

        $em->flush();
        $this->isAdding = false;
    }
}
