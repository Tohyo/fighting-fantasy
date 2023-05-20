<?php

namespace App\Twig\Components;

use App\Entity\AdventureSheet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('removeItemFromInventory')]
final class RemoveItemFromInventoryComponent
{
    use DefaultActionTrait;

    #[LiveProp]
    public bool $deleted = false;

    #[LiveProp]
    public string $item;

    #[LiveProp]
    public AdventureSheet $adventureSheet;

    #[LiveAction]
    public function deleteItem(EntityManagerInterface $em): void
    {
        $this->adventureSheet->removeItem($this->item);

        $em->flush();
        $this->deleted = true;
    }
}
