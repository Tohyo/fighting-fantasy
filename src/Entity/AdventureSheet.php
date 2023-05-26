<?php

namespace App\Entity;

use App\Repository\AdventureSheetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdventureSheetRepository::class)]
class AdventureSheet
{
    #[ORM\Id]
    #[ORM\Column(type: Types::GUID)]
    public readonly string $id;

    #[ORM\Column]
    public int $skill;

    #[ORM\Column]
    public int $stamina;

    #[ORM\Column]
    public int $luck;

    #[ORM\Column]
    public int $initialSkill;

    #[ORM\Column]
    public int $initialStamina;

    #[ORM\Column]
    public int $initialLuck;

    /** @var array<string> $inventory */
    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    public array $inventory = [];

    public function __construct()
    {
        $this->id = uuid_create(UUID_TYPE_RANDOM);

        $skill = random_int(7, 12);
        $stamina = random_int(14, 24);
        $luck = random_int(7, 12);

        $this->skill = $skill;
        $this->stamina = $stamina;
        $this->luck = $luck;
        $this->initialSkill = $skill;
        $this->initialStamina = $stamina;
        $this->initialLuck = $luck;
    }

    public function addItem(string $item): self
    {
        array_push($this->inventory, $item);

        return $this;
    }

    public function removeItem(string $item): self
    {
        $this->inventory = array_diff($this->inventory, [$item]);

        return $this;
    }

    public function addLuck(?int $luck = null): self
    {
        if ($luck) {
            $this->luck += $luck;
        } else {
            $this->luck++;
        }

        return $this;
    }

    public function removeLuck(?int $luck = null): self
    {
        if ($luck) {
            $this->luck -= $luck;
        } else {
            $this->luck--;
        }

        return $this;
    }

    public function addStamina(?int $stamina = null): self
    {
        if ($stamina) {
            $this->stamina += $stamina;
        } else {
            $this->stamina++;
        }

        return $this;
    }

    public function removeStamina(?int $stamina = null): self
    {
        if ($stamina) {
            $this->stamina -= $stamina;
        } else {
            $this->stamina--;
        }

        return $this;
    }

    public function addSkill(?int $skill = null): self
    {
        if ($skill) {
            $this->skill += $skill;
        } else {
            $this->skill++;
        }

        return $this;
    }

    public function removeSkill(?int $skill = null): self
    {
        if ($skill) {
            $this->skill -= $skill;
        } else {
            $this->skill--;
        }

        return $this;
    }
}
