<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Task\Files\Remove;

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
    public $file;

    /**
     * @param string $id
     * @param string $file
     */
    public function __construct(string $id, string $file)
    {
        $this->id = $id;
        $this->file = $file;
    }
}