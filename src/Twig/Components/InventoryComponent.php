<?php

namespace App\Twig\Components;

use App\Entity\AdventureSheet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('inventory')]
final class InventoryComponent
{
    use DefaultActionTrait;

    #[LiveProp]
    public bool $isAdding = false;

    #[LiveProp(writable: true)]
    public ?string $item = null;

    #[LiveProp]
    public AdventureSheet $adventureSheet;

    #[LiveAction]
    public function addItem(): void
    {
        $this->isAdding = true;
    }

    #[LiveAction]
    public function cancelItem(): void
    {
        $this->isAdding = false;
    }

    #[LiveAction]
    public function saveItem(EntityManagerInterface $em): void
    {
        if (!$this->item) {
            return;
        }

        $this->adventureSheet->addItem($this->item);

        $em->flush();
        $this->isAdding = false;
    }

    #[LiveAction]
    public function deleteItem(EntityManagerInterface $em, #[LiveArg] string $item): void
    {
        $this->adventureSheet->removeItem($item);

        $em->flush();
    }
}
