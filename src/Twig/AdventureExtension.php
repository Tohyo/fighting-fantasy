<?php

namespace App\Twig;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AdventureExtension extends AbstractExtension
{
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
        $content = "[#40]Test-9[#]";

        return preg_replace('/\[#(\d+)\][a-zA-Z0-9.-]+\[#\]/', $this->generateLink(1), $content);
    }

    private function generateLink(int $id): string
    {
        $url = $this->urlGenerator->generate('app_get_chapter', ['id' => $id]);

        return "<a href=".$url.">plop</a>";
    }
}