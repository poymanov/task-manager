<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Task\Files\Add;

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
     * @var File[]
     */
    public $files;

    /**
     * @param string $id
     * @param string $actor
     */
    public function __construct(string $actor, string $id)
    {
        $this->id = $id;
        $this->actor = $actor;
    }
}