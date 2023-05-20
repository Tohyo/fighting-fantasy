<?php

namespace App\Components;

use App\Entity\AdventureSheet;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class InventoryComponent
{
    use DefaultActionTrait;

    #[LiveProp]
    public bool $isAdding = false;

    #[LiveProp]
    public AdventureSheet $adventureSheet;

    #[LiveAction]
    public function addItem(): void
    {
        $this->isAdding = true;
    }

    #[LiveListener('itemAddedToInventory')]
    public function itemAdded(): void
    {
        $this->isAdding = false;
    }
}
