<?php

declare(strict_types=1);

namespace App\ReadModel\Work\Projects\Calendar;

use DateTimeImmutable;

class Result
{
    /**
     * @var array
     */
    public $items;

    /**
     * @var DateTimeImmutable
     */
    public $start;

    /**
     * @var DateTimeImmutable
     */
    public $end;

    /**
     * @var DateTimeImmutable
     */
    public $month;

    /**
     * @param array $items
     * @param DateTimeImmutable $start
     * @param DateTimeImmutable $end
     * @param DateTimeImmutable $month
     */
    public function __construct(array $items, DateTimeImmutable $start, DateTimeImmutable $end, DateTimeImmutable $month)
    {
        $this->items = $items;
        $this->start = $start;
        $this->end = $end;
        $this->month = $month;
    }
}