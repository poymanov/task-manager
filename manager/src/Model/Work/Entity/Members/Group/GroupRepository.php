<?php

declare(strict_types=1);

namespace App\Model\Work\Entity\Members\Group;

use App\Model\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class GroupRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $repo;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->repo = $em->getRepository(Group::class);
        $this->em = $em;
    }

    /**
     * @param Id $id
     * @return Group
     */
    public function get(Id $id): Group
    {
        if (!$group = $this->repo->find($id->getValue())) {
            throw new EntityNotFoundException('Group is not found.');
        }

        return $group;
    }

    /**
     * @param Group $group
     */
    public function add(Group $group): void
    {
        $this->em->persist($group);
    }

    /**
     * @param Group $group
     */
    public function remove(Group $group): void
    {
        $this->em->remove($group);
    }
}