<?php

namespace App\Security\Voter;

use App\Entity\Chapter;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ChapterVoter extends Voter
{
    public const VIEW = 'ADVENTURE_CHAPTER_VIEW';

    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return $attribute === self::VIEW && $subject instanceof \App\Entity\Chapter;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof User) {
            return false;
        }

        if (!$subject instanceof Chapter) {
            return false;
        }

        foreach ($user->getAdventures() as $adventure) {
            if ($adventure->book->id === $subject->book->id) {
                return true;
            }
        }

        return false;
    }
}
