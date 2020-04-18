<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Task\Executor\Revoke;

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
     * @var string
     * @Assert\NotBlank()
     */
    public $member;

    /**
     * @param string $actor
     * @param string $id
     * @param string $member
     */
    public function __construct(string $actor, string $id, string $member)
    {
        $this->actor = $actor;
        $this->id = $id;
        $this->member = $member;
    }
}