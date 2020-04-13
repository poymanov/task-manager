<?php

declare(strict_types=1);

namespace App\Twig\Extension\Work\Processor;

use App\Twig\Extension\Work\Processor\Driver\Driver;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ProcessorExtension extends AbstractExtension
{
    /**
     * @var Driver[]
     */
    private $drivers;

    /**
     * @param Driver[] $drivers
     */
    public function __construct(iterable $drivers)
    {
        $this->drivers = $drivers;
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
        $result = $text;
        foreach ($this->drivers as $driver) {
            $result = $driver->process($result);
        }
        return $result;
    }
}