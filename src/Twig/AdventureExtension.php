<?php

namespace App\Twig;

use App\Entity\Chapter;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

final class AdventureExtension extends AbstractExtension
{
    private const LINK_REGEX = '/\[#(\d+)\]([\w\s.-]+)\[#\]/';

    public function __construct(
        private readonly UrlGeneratorInterface $urlGenerator
    ) {}

    public function getFilters(): array
    {
        return [
            new TwigFilter('adventure', [$this, 'formatAdventure']),
        ];
    }

    public function formatAdventure(Chapter $chapter): ?string
    {
        return preg_replace_callback(
            self::LINK_REGEX,
            function (array $matches) use ($chapter) {
                return $this->generateLink($matches, $chapter);
            },
            $chapter->content
        );
    }

    /** @param array<int|string, string> $matches */
    private function generateLink(array $matches, Chapter $chapter): string
    {
        $url = $this->urlGenerator->generate('app_chapter', [
            'number' => $matches[1],
            'slug' => $chapter->book->slug,
        ]);

        return "<a href=".$url."><u>".$matches[2]."</u></a>";
    }
}
