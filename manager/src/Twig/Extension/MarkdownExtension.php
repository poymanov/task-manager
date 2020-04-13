<?php

declare(strict_types=1);

namespace App\Twig\Extension;

use cebe\markdown\MarkdownExtra;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MarkdownExtension extends AbstractExtension
{
    /**
     * @var MarkdownExtra
     */
    private $markdown;

    /**
     * @param MarkdownExtra $markdown
     */
    public function __construct(MarkdownExtra $markdown)
    {
        $this->markdown = $markdown;
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('markdown', [$this, 'markdown'], ['is_safe' => ['html']])
        ];
    }

    /**
     * @param string|null $text
     * @return string
     */
    public function markdown(?string $text): string
    {
        return $this->markdown->parse($text);
    }

}