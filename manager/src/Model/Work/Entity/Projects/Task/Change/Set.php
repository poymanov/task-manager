<?php

declare(strict_types=1);

namespace App\Model\Work\Entity\Projects\Task\Change;

use App\Model\Work\Entity\Members\Member\Id as MemberId;
use App\Model\Work\Entity\Projects\Project\Id as ProjectId;
use App\Model\Work\Entity\Projects\Task\File\Id as FileId;
use App\Model\Work\Entity\Projects\Task\File\Info;
use App\Model\Work\Entity\Projects\Task\Id as TaskId;
use App\Model\Work\Entity\Projects\Task\Status;
use App\Model\Work\Entity\Projects\Task\Type;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Set
{
    /**
     * @var ProjectId
     * @ORM\Column(type="work_projects_project_id", nullable=true)
     */
    private $projectId;

    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     */
    private $name;

    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @var Info|null
     * @ORM\Column(type="work_projects_task_file_id", nullable=true)
     */
    private $fileId;

    /**
     * @var Info|null
     * @ORM\Column(type="work_projects_task_file_id", nullable=true)
     */
    private $removedFileId;

    /**
     * @var Type
     * @ORM\Column(type="work_projects_task_type", length=16, nullable=true)
     */
    private $type;

    /**
     * @var Status|null
     * @ORM\Column(type="work_projects_task_status", nullable=true)
     */
    private $status;

    /**
     * @var int|null
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $progress;

    /**
     * @var int|null
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $priority;

    /**
     * @var TaskId
     * @ORM\Column(type="work_projects_task_id", nullable=true)
     */
    private $parentId;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $removedParent;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $plan;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $removedPlan;

    /**
     * @var MemberId
     * @ORM\Column(type="work_members_member_id", nullable=true)
     */
    private $executorId;

    /**
     * @var MemberId
     * @ORM\Column(type="work_members_member_id", nullable=true)
     */
    private $revokedExecutorId;

    private function __construct()
    {
    }

    /**
     * @param ProjectId $project
     * @param string $name
     * @param string|null $content
     * @param Type $type
     * @param int $priority
     * @return static
     */
    public static function forNewTask(ProjectId $project, string $name, ?string $content, Type $type, int $priority): self
    {
        $set = new self();
        $set->projectId = $project;
        $set->name = $name;
        $set->content = $content;
        $set->type = $type;
        $set->priority = $priority;

        return $set;
    }

    /**
     * @param string $name
     * @return static
     */
    public static function fromName(string $name): self
    {
        $set = new self();
        $set->name = $name;

        return $set;
    }

    /**
     * @param string $content
     * @return static
     */
    public static function fromContent(string $content): self
    {
        $set = new self();
        $set->content = $content;

        return $set;
    }

    /**
     * @param Type $type
     * @return static
     */
    public static function fromType(Type $type): self
    {
        $set = new self();
        $set->type = $type;

        return $set;
    }

    /**
     * @param FileId $file
     * @return static
     */
    public static function fromFile(FileId $file): self
    {
        $set = new self();
        $set->fileId = $file;

        return $set;
    }

    /**
     * @param FileId $file
     * @return static
     */
    public static function fromRemovedFile(FileId $file): self
    {
        $set = new self();
        $set->removedFileId = $file;

        return $set;
    }

    /**
     * @param Status $status
     * @return static
     */
    public static function fromStatus(Status $status): self
    {
        $set = new self();
        $set->status = $status;

        return $set;
    }

    /**
     * @param int $progress
     * @return static
     */
    public static function fromProgress(int $progress): self
    {
        $set = new self();
        $set->progress = $progress;

        return $set;
    }

    /**
     * @param int $priority
     * @return static
     */
    public static function fromPriority(int $priority): self
    {
        $set = new self();
        $set->priority = $priority;

        return $set;
    }

    /**
     * @param TaskId $parent
     * @return static
     */
    public static function fromParent(TaskId $parent): self
    {
        $set = new self();
        $set->parentId = $parent;

        return $set;
    }

    /**
     * @return static
     */
    public static function fromRemovedParent(): self
    {
        $set = new self();
        $set->removedParent = true;

        return $set;
    }

    /**
     * @param DateTimeImmutable $plan
     * @return static
     */
    public static function fromPlan(DateTimeImmutable $plan): self
    {
        $set = new self();
        $set->plan = $plan;

        return $set;
    }

    /**
     * @return static
     */
    public static function fromRemovedPlan(): self
    {
        $set = new self();
        $set->removedPlan = true;

        return $set;
    }

    /**
     * @param MemberId $executor
     * @return static
     */
    public static function fromExecutor(MemberId $executor): self
    {
        $set = new self();
        $set->executorId = $executor;

        return $set;
    }

    /**
     * @param MemberId $executor
     * @return static
     */
    public static function fromRevokedExecutor(MemberId $executor): self
    {
        $set = new self();
        $set->revokedExecutorId = $executor;

        return $set;
    }

    /**
     * @param ProjectId $project
     * @return static
     */
    public static function fromProject(ProjectId $project): self
    {
        $set = new self();
        $set->projectId = $project;

        return $set;
    }
}