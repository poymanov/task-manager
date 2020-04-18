<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Task\Plan\Set;

use App\Model\Work\Entity\Projects\Task\Task;
use DateTimeImmutable;
use Exception;
use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $actor;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $id;

    /**
     * @var DateTimeImmutable
     * @Assert\NotBlank()
     */
    public $date;

    /**
     * @param string $actor
     * @param string $id
     */
    public function __construct(string $actor, string $id)
    {
        $this->actor = $actor;
        $this->id = $id;
    }

    /**
     * @param string $actor
     * @param Task $task
     * @return static
     */
    public static function fromTask(string $actor, Task $task): self
    {
        $command = new self($actor, $task->getId()->getValue());
        $command->date = $task->getPlanDate() ?: new DateTimeImmutable();

        return $command;
    }
}