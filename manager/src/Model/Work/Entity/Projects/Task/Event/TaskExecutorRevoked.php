<?php

declare(strict_types=1);

namespace App\Model\Work\Entity\Projects\Task\Event;

use App\Model\Work\Entity\Members\Member\Id as MemberId;
use App\Model\Work\Entity\Projects\Task\Id;

class TaskExecutorRevoked
{
    /**
     * @var MemberId
     */
    public $actorId;

    /**
     * @var Id
     */
    public $taskId;

    /**
     * @var MemberId
     */
    public $executorId;

    /**
     * @param MemberId $actorId
     * @param Id $taskId
     * @param MemberId $executorId
     */
    public function __construct(MemberId $actorId, Id $taskId, MemberId $executorId)
    {
        $this->actorId = $actorId;
        $this->taskId = $taskId;
        $this->executorId = $executorId;
    }
}