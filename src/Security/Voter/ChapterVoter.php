<?php

namespace App\Security\Voter;

use App\Entity\Chapter;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class ChapterVoter extends Voter
{
    public const VIEW = 'CHAPTER_VIEW';
    public const EDIT = 'CHAPTER_EDIT';
    public const ADVENTURE = 'ADVENTURE_CHAPTER_VIEW';

    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::VIEW, self::EDIT ])
            && $subject instanceof \App\Entity\Chapter;
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

        return match ($attribute) {
            self::ADVENTURE => $this->hasActiveAdventure($user, $subject),
            self::EDIT => $user === $subject->book->creator,
            self::VIEW => $user === $subject->book->creator,
            default => false,
        };
    }

    private function hasActiveAdventure(UserInterface $user, Chapter $chapter): bool
    {
        foreach ($user->getAdventures() as $adventure) {
            if ($adventure->book->id === $chapter->book->id) {
                return true;
            }
        }

        return false;
    }
}
