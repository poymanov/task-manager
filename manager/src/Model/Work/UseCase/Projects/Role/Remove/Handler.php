<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Role\Remove;

use App\Model\Flusher;
use App\Model\Work\Entity\Projects\Role\Id;
use App\Model\Work\Entity\Projects\Role\RoleRepository;

class Handler
{
    /**
     * @var RoleRepository
     */
    private $roles;

    /**
     * @var Flusher
     */
    private $flusher;

    /**
     * @param RoleRepository $roles
     * @param Flusher $flusher
     */
    public function __construct(RoleRepository $roles, Flusher $flusher)
    {
        $this->roles = $roles;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     */
    public function handle(Command $command): void
    {
        $role = $this->roles->get(new Id($command->id));

        $this->roles->remove($role);

        $this->flusher->flush();
    }
}