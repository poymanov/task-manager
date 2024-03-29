<?php

declare(strict_types=1);

namespace App\Model;

use Doctrine\ORM\EntityManagerInterface;

class Flusher
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var EventDispatcher
     */
    private $dispatcher;

    /**
     * @param EntityManagerInterface $em
     * @param EventDispatcher $dispatcher
     */
    public function __construct(EntityManagerInterface $em, EventDispatcher $dispatcher)
    {
        $this->em = $em;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param AggregateRoot ...$roots
     */
    public function flush(AggregateRoot ...$roots): void
    {
        $this->em->flush();

        foreach ($roots as $root) {
            $this->dispatcher->dispatch($root->releaseEvents());
        }
    }
}