<?php

declare(strict_types=1);

namespace App\ReadModel\Work\Projects\Action;

class Filter
{
    /**
     * @var string
     */
    public $member;

    /**
     * @var string|null
     */
    public $project;

    /**
     * @param string|null $project
     */
    public function __construct(?string $project)
    {
        $this->project = $project;
    }

    /**
     * @param string $project
     * @return static
     */
    public static function forProject(string $project): self
    {
        return new self($project);
    }

    /**
     * @return static
     */
    public static function all(): self
    {
        return new self(null);
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