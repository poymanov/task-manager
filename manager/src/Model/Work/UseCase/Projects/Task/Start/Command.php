<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Task\Start;

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
     * @param string $actor
     * @param string $id
     */
    public function __construct(string $actor, string $id)
    {
        $this->actor = $actor;
        $this->id = $id;
    }
}