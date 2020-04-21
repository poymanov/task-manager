<?php

declare(strict_types=1);

namespace App\Service\Work\Processor;

use App\Service\Work\Processor\Driver\Driver;

class Processor
{
    /**
     * @var Driver[]
     */
    private $drivers;

    /**
     * @param iterable $drivers
     */
    public function __construct(iterable $drivers)
    {
        $this->drivers = $drivers;
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