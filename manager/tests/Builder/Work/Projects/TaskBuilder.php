<?php

declare(strict_types=1);

namespace App\Tests\Builder\Work\Projects;

use App\Model\Work\Entity\Members\Member\Member;
use App\Model\Work\Entity\Projects\Project\Project;
use App\Model\Work\Entity\Projects\Task\Id;
use App\Model\Work\Entity\Projects\Task\Task;
use App\Model\Work\Entity\Projects\Task\Type;
use DateTimeImmutable;
use Exception;

class TaskBuilder
{
    /**
     * @var Id
     */
    private $id;

    /**
     * @var DateTimeImmutable
     */
    private $date;

    /**
     * @var Type
     */
    private $type;

    /**
     * @var int
     */
    private $priority;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $content;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->id = Id::next();
        $this->date = new DateTimeImmutable();
        $this->type = new Type(Type::FEATURE);
        $this->priority = 1;
        $this->name = 'Task';
        $this->content = 'Content';
    }

    /**
     * @param Id $id
     * @return $this
     */
    public function withId(Id $id): self
    {
        $clone = clone $this;
        $clone->id = $id;

        return $clone;
    }

    /**
     * @param Type $type
     * @return $this
     */
    public function withType(Type $type): self
    {
        $clone = clone $this;
        $clone->type = $type;

        return $clone;
    }

    /**
     * @param Project $project
     * @param Member $author
     * @return Task
     */
    public function build(Project $project, Member $author): Task
    {
        return new Task(
            $this->id,
            $project,
            $author,
            $this->date,
            $this->name,
            $this->content,
            $this->type,
            $this->priority
        );
    }

}