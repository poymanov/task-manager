<?php

declare(strict_types=1);

namespace App\ReadModel\Work\Members\Members\Member;

use App\Model\Work\Entity\Members\Member\Member;
use App\Model\Work\Entity\Members\Member\Status;
use App\ReadModel\Work\Members\Members\Member\Filter\Filter;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\FetchMode;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use UnexpectedValueException;

class MemberFetcher
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var PaginatorInterface
     */
    private $paginator;

    /**
     * @var EntityManagerInterface
     */
    private $repository;

    /**
     * @param Connection $connection
     * @param PaginatorInterface $paginator
     * @param EntityManagerInterface $repository
     */
    public function __construct(Connection $connection, PaginatorInterface $paginator, EntityManagerInterface $em)
    {
        $this->connection = $connection;
        $this->paginator = $paginator;
        $this->repository = $em->getRepository(Member::class);
    }

    /**
     * @param string $id
     * @return Member|null
     */
    public function find(string $id): ?Member
    {
        return $this->repository->find($id);
    }

    public function all(Filter $filter, int $page, int $size, string $sort, string $direction): PaginationInterface
    {
        $qb = $this->connection->createQueryBuilder()
            ->select(
                'm.id',
                'TRIM(CONCAT(m.name_first, \' \', m.name_last)) AS name',
                'm.email',
                'g.name as group',
                'm.status',
                '(SELECT COUNT(*) FROM work_projects_project_membership ms WHERE ms.member_id = m.id) as memberships_count'
            )
            ->from('work_members_members', 'm')
            ->innerJoin('m', 'work_members_groups', 'g', 'm.group_id = g.id');

        if ($filter->name) {
            $qb->andWhere($qb->expr()->like('LOWER(CONCAT(m.name_first, \' \', m.name_last))', ':name'));
            $qb->setParameter(':name', '%' . mb_strtolower($filter->name) . '%');
        }

        if ($filter->email) {
            $qb->andWhere($qb->expr()->like('LOWER(m.email)', ':email'));
            $qb->setParameter(':email', '%' . mb_strtolower($filter->email) . '%');
        }

        if ($filter->status) {
            $qb->andWhere('m.status = :status');
            $qb->setParameter(':status', $filter->status);
        }

        if ($filter->group) {
            $qb->andWhere('m.group_id = :group');
            $qb->setParameter(':group', $filter->group);
        }

        if (!in_array($sort, ['name', 'email', 'group', 'status'], true)) {
            throw new UnexpectedValueException('Cannot sort by ' . $sort);
        }

        $qb->orderBy($sort, $direction === 'desc' ? 'desc' : 'asc');

        return $this->paginator->paginate($qb, $page, $size);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function exists(string $id): bool
    {
        return $this->connection->createQueryBuilder()
            ->select('COUNT (id)')
            ->from('work_members_members')
            ->where('id = :id')
            ->setParameter(':id', $id)
            ->execute()->fetchColumn() > 0;
    }

    /**
     * @return array
     */
    public function activeGroupedList(): array
    {
        $stmt = $this->connection->createQueryBuilder()
            ->select([
                'm.id',
                'CONCAT(m.name_first, \' \', m.name_last) as name',
                'g.name AS group'
            ])
            ->from('work_members_members', 'm')
            ->leftJoin('m', 'work_members_groups', 'g', 'g.id = m.group_id')
            ->andWhere('m.status = :status')
            ->setParameter('status', Status::ACTIVE)
            ->orderBy('g.name')->addOrderBy('name')
            ->execute();

        return $stmt->fetchAll(FetchMode::ASSOCIATIVE);
    }

    /**
     * @param string $project
     * @return array
     */
    public function activeDepartmentListForProject(string $project): array
    {
        $stmt = $this->connection->createQueryBuilder()
            ->select([
                'm.id',
                'CONCAT(m.name_first, \' \', m.name_last) AS name',
                'd.name AS department'
            ])
            ->from('work_members_members', 'm')
            ->innerJoin('m', 'work_projects_project_membership', 'ms', 'ms.member_id = m.id')
            ->innerJoin('ms', 'work_projects_project_membership_departments', 'msd', 'msd.membership_id = ms.id')
            ->innerJoin('msd', 'work_projects_project_departments', 'd', 'd.id = msd.department_id')
            ->andWhere('m.status = :status AND ms.project_id = :project')
            ->setParameter(':status', Status::ACTIVE)
            ->setParameter(':project', $project)
            ->orderBy('d.name')->addOrderBy('name')
            ->execute();

        return $stmt->fetchAll(FetchMode::ASSOCIATIVE);
    }
}