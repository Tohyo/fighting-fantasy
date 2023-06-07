<?php

namespace App\Security\Voter;

use App\Enum\AdventureStatusEnum;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class AdventureVoter extends Voter
{
    public const RESIGN = 'ADVENTURE_RESIGN';

    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::RESIGN])
            && $subject instanceof \App\Entity\Adventure;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }


        return match ($attribute) {
            self::RESIGN => $subject->player === $user && $subject->status === AdventureStatusEnum::ACTIVE->value,
            default => false,
        };

        return false;
    }
}
