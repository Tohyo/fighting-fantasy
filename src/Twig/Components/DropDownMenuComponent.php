<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('drop_down_menu')]
final class DropDownMenuComponent
{
    use DefaultActionTrait;

    #[LiveProp]
    public bool $open = false;

    #[LiveProp]
    public array $items;

    #[LiveAction]
    public function toogle(): void
    {
        $this->open = !$this->open;
    }
}
