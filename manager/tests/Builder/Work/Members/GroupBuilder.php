<?php

declare(strict_types=1);

namespace App\Tests\Builder\Work\Members;

use App\Model\Work\Entity\Members\Group\Group;
use App\Model\Work\Entity\Members\Group\Id;
use Exception;

class GroupBuilder
{
    /**
     * @var string
     */
    private $name;

    public function __construct()
    {
        $this->name = 'Group';
    }

    /**
     * @return Group
     * @throws Exception
     */
    public function build(): Group
    {
        return new Group(Id::next(), $this->name);
    }
}