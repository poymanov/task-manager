<?php

declare(strict_types=1);

namespace App\ReadModel\Work\Members;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\FetchMode;

class GroupFetcher
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return array
     */
    public function assoc(): array
    {
        $stmt = $this->connection->createQueryBuilder()
            ->select('id', 'name')
            ->from('work_members_groups')
            ->orderBy('name')
            ->execute();

        return array_column($stmt->fetchAll(FetchMode::ASSOCIATIVE), 'name', 'id');
    }

    /**
     * @return array
     */
    public function all(): array
    {
        $stmt = $this->connection->createQueryBuilder()
            ->select(
                'g.id',
                'g.name',
                '(SELECT COUNT(*) FROM work_members_members m WHERE m.group_id = g.id) as members'
            )
            ->from('work_members_groups', 'g')
            ->orderBy('name')
            ->execute();

        return $stmt->fetchAll(FetchMode::ASSOCIATIVE);
    }
}