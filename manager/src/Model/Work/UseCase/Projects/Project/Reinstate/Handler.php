<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Project\Reinstate;

use App\Model\Flusher;
use App\Model\Work\Entity\Projects\Project\Id;
use App\Model\Work\Entity\Projects\Project\ProjectRepository;


class Handler
{
    /**
     * @var ProjectRepository
     */
    private $projects;

    /**
     * @var Flusher
     */
    private $flusher;

    /**
     * @param ProjectRepository $projects
     * @param Flusher $flusher
     */
    public function __construct(ProjectRepository $projects, Flusher $flusher)
    {
        $this->projects = $projects;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     */
    public function handle(Command $command): void
    {
        $project = $this->projects->get(new Id($command->id));

        $project->reinstate();

        $this->flusher->flush();
    }
}