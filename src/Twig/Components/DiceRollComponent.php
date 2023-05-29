<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('diceRoll')]
final class DiceRollComponent
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public int $diceNumber = 2;

    #[LiveProp(writable: true)]
    public ?int $diceRoll = null;

    #[LiveAction]
    public function rollDice(): void
    {
        $this->diceRoll = random_int(1 * $this->diceNumber, 6 * $this->diceNumber);
    }

    #[LiveAction]
    public function updateDiceNumber(#[LiveArg] string $direction): void
    {
        if ($direction === 'up') {
            $this->diceNumber++;
        } else {
            $this->diceNumber--;
        }
    }
}
