<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Task\Create;

use App\Model\Work\Entity\Projects\Task\Type;
use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $project;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $member;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $name;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $content;

    /**
     * @var string
     */
    public $parent;

    /**
     * @var DateTimeImmutable
     * @Assert\Date()
     */
    public $plan;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $type;

    /**
     * @var int
     * @Assert\NotBlank()
     */
    public $priority;

    /**
     * @param string $project
     * @param string $member
     */
    public function __construct(string $project, string $member)
    {
        $this->project = $project;
        $this->member = $member;
        $this->type = Type::NONE;
        $this->priority = 2;
    }
}