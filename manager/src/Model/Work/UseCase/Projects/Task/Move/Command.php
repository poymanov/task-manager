<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Task\Move;

use App\Model\Work\Entity\Projects\Task\Task;
use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $id;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $project;

    /**
     * @var bool
     * @Assert\Type("bool")
     */
    public $withChildren;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param Task $task
     * @return static
     */
    public static function fromTask(Task $task): self
    {
        $command = new self($task->getId()->getValue());
        $command->project = $task->getProject()->getId()->getValue();

        return $command;
    }

}