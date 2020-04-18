<?php

declare(strict_types=1);

namespace App\ReadModel\Work\Projects\Calendar\Query;

use DateTimeImmutable;

class Query
{
    /**
     * @var string
     */
    public $member;

    /**
     * @var string
     */
    public $project;

    /**
     * @var int
     */
    public $year;

    /**
     * @var int
     */
    public $month;

    /**
     * @param int $year
     * @param int $month
     */
    public function __construct(int $year, int $month)
    {
        $this->year = $year;
        $this->month = $month;
    }

    /**
     * @param DateTimeImmutable $date
     * @return static
     */
    public static function fromDate(DateTimeImmutable $date): self
    {
        return new self(
            (int) $date->format('Y'),
            (int) $date->format('m')
        );
    }

    /**
     * @param string $project
     * @return $this
     */
    public function forProject(string $project): self
    {
        $clone = clone $this;
        $clone->project = $project;

        return $clone;
    }

    /**
     * @param string $member
     * @return $this
     */
    public function forMember(string $member): self
    {
        $clone = clone $this;
        $clone->member = $member;

        return $clone;
    }
}