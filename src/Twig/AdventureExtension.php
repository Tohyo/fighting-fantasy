<?php

namespace App\Twig;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AdventureExtension extends AbstractExtension
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

    public function formatAdventure(string $content): ?string
    {
        return preg_replace_callback(
            self::LINK_REGEX,
            function (array $matches) {
                return $this->generateLink($matches);
            },
            $content
        );
    }

    private function generateLink(array $matches): string
    {
        $url = $this->urlGenerator->generate('app_chapter', ['id' => $matches[1]]);

        return "<a href=".$url.">".$matches[2]."</a>";
    }
}
