<?php

declare(strict_types=1);

namespace App\Twig\Extension\Work\Processor;

use App\Service\Work\Processor\Processor;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ProcessorExtension extends AbstractExtension
{
    /**
     * @var Processor
     */
    private $processor;

    /**
     * @param Processor $processor
     */
    public function __construct(Processor $processor)
    {
        $this->processor = $processor;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('work_processor', [$this, 'process'], ['is_safe' => ['html']])
        ];
    }

    /**
     * @param string|null $text
     * @return string
     */
    public function process(?string $text): string
    {
       return $this->processor->process($text);
    }


}