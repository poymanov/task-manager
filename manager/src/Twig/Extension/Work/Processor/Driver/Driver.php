<?php

namespace App\Twig\Extension\Work\Processor\Driver;

interface Driver
{
    public function process(string $text): string;
}