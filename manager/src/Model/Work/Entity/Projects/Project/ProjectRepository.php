<?php

declare(strict_types=1);

namespace App\Model\Work\Entity\Projects\Project;

use App\Model\EntityNotFoundException;
use App\Model\Work\Entity\Projects\Role\Id as RoleId;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class ProjectRepository
{
    /**
     * @var EntityRepository
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
        $this->repo = $em->getRepository(Project::class);
        $this->em = $em;
    }

    /**
     * @param RoleId $id
     * @return bool
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function hasMembersWithRole(RoleId $id): bool
    {
        return $this->repo->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->innerJoin('p.memberships', 'ms')
            ->innerJoin('ms.roles', 'r')
            ->andWhere('r.id = :role')
            ->setParameter(':role', $id->getValue())
            ->getQuery()->getSingleScalarResult() > 0;
    }
    
    /**
     * @param Id $id
     * @return Project
     */
    public function get(Id $id): Project
    {
        if (!$project = $this->repo->find($id->getValue())) {
            throw new EntityNotFoundException('Project is not found.');
        }

        return $project;
    }

    /**
     * @param Project $project
     */
    public function add(Project $project): void
    {
        $this->em->persist($project);
    }

    /**
     * @param Project $project
     */
    public function remove(Project $project): void
    {
        $this->em->remove($project);
    }
}