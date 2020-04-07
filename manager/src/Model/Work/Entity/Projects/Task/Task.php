<?php

declare(strict_types=1);

namespace App\Model\Work\Entity\Projects\Task;

use App\Model\Work\Entity\Members\Member\Id as MemberId;
use App\Model\Work\Entity\Members\Member\Member;
use App\Model\Work\Entity\Projects\Project\Project;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use DomainException;
use Webmozart\Assert\Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="work_projects_tasks", indexes={
 *      @ORM\Index(columns={"date"})
 * })
 */
class Task
{
    /**
     * @var Id
     * @ORM\Column(type="work_projects_task_id")
     * @ORM\Id
     */
    private $id;

    /**
     * @var Project
     * @ORM\ManyToOne(targetEntity="App\Model\Work\Entity\Projects\Project\Project")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id", nullable=false)
     */
    private $project;

    /**
     * @var Member
     * @ORM\ManyToOne(targetEntity="App\Model\Work\Entity\Members\Member\Member")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
     */
    private $author;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable")
     */
    private $date;

    /**
     * @var DateTimeImmutable|null
     * @ORM\Column(type="date_immutable", nullable=true)
     */
    private $startDate;

    /**
     * @var DateTimeImmutable|null
     * @ORM\Column(type="date_immutable", nullable=true)
     */
    private $endDate;

    /**
     * @var DateTimeImmutable|null
     * @ORM\Column(type="date_immutable", nullable=true)
     */
    private $planDate;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @var Type
     * @ORM\Column(type="work_projects_task_type", length=16)
     */
    private $type;

    /**
     * @var int
     * @ORM\Column(type="smallint")
     */
    private $progress;

    /**
     * @var int
     * @ORM\Column(type="smallint")
     */
    private $priority;

    /**
     * @var Task|null
     * @ORM\ManyToOne(targetEntity="Task")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $parent;

    /**
     * @var Status
     * @ORM\Column(type="work_projects_project_status", length=16)
     */
    private $status;

    /**
     * @var ArrayCollection|Member[]
     * @ORM\ManyToMany(targetEntity="App\Model\Work\Entity\Members\Member\Member")
     * @ORM\JoinTable(name="work_projects_tasks_executors",
     *     joinColumns={@ORM\JoinColumn(name="task_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="member_id", referencedColumnName="id")}
     * )
     * @ORM\OrderBy({"name.first" = "ASC"})
     */
    private $executors;

    /**
     * @param Id $id
     * @param Project $project
     * @param Member $author
     * @param DateTimeImmutable $date
     * @param string $name
     * @param string|null $content
     * @param Type $type
     * @param int $priority
     */
    public function __construct(
        Id $id,
        Project $project,
        Member $author,
        DateTimeImmutable $date,
        string $name,
        ?string $content,
        Type $type,
        int $priority
    )
    {
        $this->id = $id;
        $this->project = $project;
        $this->author = $author;
        $this->date = $date;
        $this->name = $name;
        $this->content = $content;
        $this->type = $type;
        $this->progress = 0;
        $this->priority = $priority;
        $this->status = Status::new();
        $this->executors = new ArrayCollection();
    }

    /**
     * @param string $name
     * @param string|null $content
     */
    public function edit(string $name, ?string $content): void
    {
        $this->name = $name;
        $this->content = $content;
    }

    /**
     * @param DateTimeImmutable $date
     */
    public function start(DateTimeImmutable $date): void
    {
        if (!$this->isNew()) {
            throw new DomainException('Task is already started.');
        }

        if (!$this->executors->count()) {
            throw new DomainException('Task does not contain executors.');
        }

        $this->changeStatus(Status::working(), $date);
    }

    /**
     * @param Task|null $parent
     */
    public function setChildOf(?Task $parent): void
    {
        if ($parent) {
            $current = $parent;
            do {
                if ($current === $this) {
                    throw new DomainException('Cyclomatic children.');
                }
            }
            while($current && $current = $current->getParent());
        }

        $this->parent = $parent;
    }

    /**
     * @param DateTimeImmutable|null $date
     */
    public function plan(?DateTimeImmutable $date): void
    {
        $this->planDate = $date;
    }

    /**
     * @param Project $project
     */
    public function move(Project $project): void
    {
        if ($project === $this->project) {
            throw new DomainException('Project is already same.');
        }

        $this->project = $project;
    }

    /**
     * @param Type $type
     */
    public function changeType(Type $type): void
    {
        if ($this->type->isEqual($type)) {
            throw new DomainException('Type is already same.');
        }

        $this->type = $type;
    }

    /**
     * @param Status $status
     * @param DateTimeImmutable $date
     */
    public function changeStatus(Status $status, DateTimeImmutable $date): void
    {
        if ($this->status->isEqual($status)) {
            throw new DomainException('Status is already same.');
        }

        $this->status = $status;

        if (!$status->isNew() && !$this->startDate) {
            $this->startDate = $date;
        }

        if ($status->isDone()) {
            if ($this->progress !== 100) {
                $this->changeProgress(100);
            }
            $this->endDate = $date;
        } else {
            $this->endDate = null;
        }
    }

    /**
     * @param int $progress
     */
    public function changeProgress(int $progress): void
    {
        Assert::range($progress, 0, 100);
        if ($progress === $this->progress) {
            throw new DomainException('Progress is already same.');
        }

        $this->progress = $progress;
    }

    /**
     * @param int $priority
     */
    public function changePriority(int $priority): void
    {
        Assert::range($priority, 1, 4);
        if ($priority === $this->priority) {
            throw new DomainException('Priority is already same.');
        }

        $this->priority = $priority;
    }

    /**
     * @param MemberId $id
     * @return bool
     */
    public function hasExecutor(MemberId $id): bool
    {
        foreach ($this->executors as $executor) {
            if ($executor->getId()->isEqual($id)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param Member $executor
     */
    public function assignExecutor(Member $executor): void
    {
        if ($this->executors->contains($executor)) {
            throw new DomainException('Executor is already assigned.');
        }

        $this->executors->add($executor);
    }

    /**
     * @param MemberId $id
     */
    public function revokeExecutor(MemberId $id): void
    {
        foreach ($this->executors as $current) {
            if ($current->getId()->isEqual($id)) {
                $this->executors->removeElement($current);
                return;
            }
        }

        throw new DomainException('Executor is not assigned.');
    }

    /**
     * @return bool
     */
    public function isNew(): bool
    {
        return $this->status->isNew();
    }

    /**
     * @return bool
     */
    public function isWorking(): bool
    {
        return $this->status->isWorking();
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return Project
     */
    public function getProject(): Project
    {
        return $this->project;
    }

    /**
     * @return Member
     */
    public function getAuthor(): Member
    {
        return $this->author;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getPlanDate(): ?DateTimeImmutable
    {
        return $this->planDate;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getStartDate(): ?DateTimeImmutable
    {
        return $this->startDate;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getEndDate(): ?DateTimeImmutable
    {
        return $this->endDate;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getProgress(): int
    {
        return $this->progress;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @return Task|null
     */
    public function getParent(): ?Task
    {
        return $this->parent;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @return Member[]
     */
    public function getExecutors(): array
    {
        return $this->executors->toArray();
    }
}