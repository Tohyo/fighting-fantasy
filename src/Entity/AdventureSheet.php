<?php

namespace App\Entity;

use App\Repository\AdventureSheetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdventureSheetRepository::class)]
class AdventureSheet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $skill = null;

    #[ORM\Column]
    private ?int $stamina = null;

    #[ORM\Column]
    private ?int $luck = null;

    #[ORM\Column]
    private ?int $initialSkill = null;

    #[ORM\Column]
    private ?int $initialStamina = null;

    #[ORM\Column]
    private ?int $initialLuck = null;

    /** @var array<string> $inventory */
    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private array $inventory = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSkill(): ?int
    {
        return $this->skill;
    }

    public function setSkill(int $skill): self
    {
        $this->skill = $skill;

        return $this;
    }

    public function getStamina(): ?int
    {
        return $this->stamina;
    }

    public function setStamina(int $stamina): self
    {
        $this->stamina = $stamina;

        return $this;
    }

    public function getLuck(): ?int
    {
        return $this->luck;
    }

    public function setLuck(int $luck): self
    {
        $this->luck = $luck;

        return $this;
    }

    public function getInitialSkill(): ?int
    {
        return $this->initialSkill;
    }

    public function setInitialSkill(int $initialSkill): self
    {
        $this->initialSkill = $initialSkill;

        return $this;
    }

    public function getInitialStamina(): ?int
    {
        return $this->initialStamina;
    }

    public function setInitialStamina(int $initialStamina): self
    {
        $this->initialStamina = $initialStamina;

        return $this;
    }

    public function getInitialLuck(): ?int
    {
        return $this->initialLuck;
    }

    public function setInitialLuck(int $initialLuck): self
    {
        $this->initialLuck = $initialLuck;

        return $this;
    }

    /** @return array<string> */
    public function getInventory(): array
    {
        return $this->inventory;
    }

    /** @param array<string> $inventory */
    public function setInventory(array $inventory): self
    {
        $this->inventory = $inventory;

        return $this;
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
