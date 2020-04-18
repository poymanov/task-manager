<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Task\Take;

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
    public $actor;

    /**
     * @param string $id
     * @param string $actor
     */
    public function __construct(string $id, string $actor)
    {
        $this->id = $id;
        $this->actor = $actor;
    }
}