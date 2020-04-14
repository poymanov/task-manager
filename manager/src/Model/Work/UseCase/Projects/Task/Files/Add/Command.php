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
    public $member;

    /**
     * @var File[]
     */
    public $files;

    /**
     * @param string $id
     * @param string $member
     */
    public function __construct(string $id, string $member)
    {
        $this->id = $id;
        $this->member = $member;
    }
}