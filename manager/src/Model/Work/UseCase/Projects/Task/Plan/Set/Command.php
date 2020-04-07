<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Task\Plan\Set;

use App\Model\Work\Entity\Projects\Task\Task;
use DateTimeImmutable;
use Exception;

class Command
{
    /**
     * @var
     */
    public $id;

    /**
     * @var DateTimeImmutable
     */
    public $date;

    /**
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @param Task $task
     * @return static
     * @throws Exception
     */
    public static function fromTask(Task $task): self
    {
        $command = new self($task->getId()->getValue());
        $command->date = $task->getPlanDate() ?: new DateTimeImmutable();

        return $command;
    }
}