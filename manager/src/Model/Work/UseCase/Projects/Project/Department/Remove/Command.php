<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Project\Department\Remove;

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
    public $id;

    /**
     * @param string $project
     * @param string $id
     */
    public function __construct(string $project, string $id)
    {
        $this->project = $project;
        $this->id = $id;
    }
}