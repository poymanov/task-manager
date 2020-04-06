<?php

declare(strict_types=1);

namespace App\Tests\Builder\Work\Projects;

use App\Model\Work\Entity\Projects\Project\Id;
use App\Model\Work\Entity\Projects\Project\Project;
use Exception;

class ProjectBuilder
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $sort;

    public function __construct()
    {
        $this->name = 'Project';
        $this->sort = 1;
    }

    /**
     * @return Project
     * @throws Exception
     */
    public function build(): Project
    {
        return new Project(
            Id::next(),
            $this->name,
            $this->sort
        );
    }

}