<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Project\Membership\Remove;

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
     * @param string $project
     * @param string $member
     */
    public function __construct(string $project, string $member)
    {
        $this->project = $project;
        $this->member = $member;
    }
}