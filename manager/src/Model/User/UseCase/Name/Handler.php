<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\Name;

use App\Model\Flusher;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\Name;
use App\Model\User\Entity\User\UserRepository;

class Handler
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var Flusher
     */
    private $flusher;

    /**
     * @param UserRepository $users
     * @param Flusher $flusher
     */
    public function __construct(UserRepository $users, Flusher $flusher)
    {
        $this->users = $users;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     */
    public function handle(Command $command): void
    {
        $user = $this->users->get(new Id($command->id));

        $user->changeName(new Name($command->first, $command->last));

        $this->flusher->flush();
    }
}