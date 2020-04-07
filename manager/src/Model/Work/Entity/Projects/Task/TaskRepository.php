<?php

declare(strict_types=1);

namespace App\Model\Work\Entity\Projects\Task;

use App\Model\EntityNotFoundException;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;

class TaskRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $repo;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->repo = $em->getRepository(Task::class);
        $this->connection = $em->getConnection();
        $this->em = $em;
    }

    /**
     * @param Id $id
     * @return array
     */
    public function allByParent(Id $id): array
    {
        return $this->repo->findBy(['parent' => $id->getValue()]);
    }

    /**
     * @param Id $id
     * @return Task
     */
    public function get(Id $id): Task
    {
        /** @var Task $task */
        if (!$task = $this->repo->find($id->getValue())) {
            throw new EntityNotFoundException('Task is not found.');
        }

        return $task;
    }

    /**
     * @param Task $task
     */
    public function add(Task $task): void
    {
        $this->em->persist($task);
    }

    /**
     * @param Task $task
     */
    public function remove(Task $task): void
    {
        $this->em->remove($task);
    }
}