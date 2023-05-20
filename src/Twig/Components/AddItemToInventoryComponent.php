<?php

namespace App\Twig\Components;

use App\Entity\AdventureSheet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentToolsTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('addItemToIventory')]
final class AddItemToInventoryComponent
{
    use DefaultActionTrait;
    use ComponentToolsTrait;

    #[LiveProp(writable: true)]
    public ?string $item = null;

    #[LiveProp]
    public AdventureSheet $adventureSheet;

    #[LiveAction]
    public function saveItem(EntityManagerInterface $em): void
    {
        $this->adventureSheet->addItem($this->item);

        $em->flush();
        $this->emit('itemAddedToInventory');
    }
}
