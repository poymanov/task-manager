<?php

declare(strict_types=1);

namespace App\ReadModel\Work\Projects\Task\Filter;

class Filter
{
    /**
     * @var string
     */
    public $member;

    /**
     * @var string
     */
    public $author;

    /**
     * @var string|null
     */
    public $project;

    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $priority;

    /**
     * @var string
     */
    public $executor;

    /**
     * @var string
     */
    public $roots;

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

    /**
     * @param string $author
     * @return $this
     */
    public function forAuthor(string $author): self
    {
        $clone = clone $this;
        $clone->author = $author;
        return $clone;
    }

    /**
     * @param string $executor
     * @return $this
     */
    public function forExecutor(string $executor): self
    {
        $clone = clone $this;
        $clone->executor = $executor;
        return $clone;
    }
}