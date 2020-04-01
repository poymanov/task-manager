<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Members\Group\Remove;

use App\Model\Flusher;
use App\Model\Work\Entity\Members\Group\GroupRepository;
use App\Model\Work\Entity\Members\Group\Id;
use App\Model\Work\Entity\Members\Member\MemberRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use DomainException;

class Handler
{
    /**
     * @var GroupRepository
     */
    private $groups;

    /**
     * @var Flusher
     */
    private $flusher;

    /**
     * @var MemberRepository
     */
    private $members;

    /**
     * @param GroupRepository $groups
     * @param Flusher $flusher
     * @param MemberRepository $members
     */
    public function __construct(GroupRepository $groups, Flusher $flusher, MemberRepository $members)
    {
        $this->groups = $groups;
        $this->flusher = $flusher;
        $this->members = $members;
    }

    /**
     * @param Command $command
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function handle(Command $command): void
    {
        $group = $this->groups->get(new Id($command->id));

        if ($this->members->hasByGroup($group->getId())) {
            throw new DomainException('Group is not empty.');
        }

        $this->groups->remove($group);

        $this->flusher->flush();
    }

}