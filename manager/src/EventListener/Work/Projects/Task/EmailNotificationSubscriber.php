<?php

declare(strict_types=1);

namespace App\EventListener\Work\Projects\Task;

use App\Model\Work\Entity\Members\Member\MemberRepository;
use App\Model\Work\Entity\Projects\Task\Event\TaskExecutorAssigned;
use App\Model\Work\Entity\Projects\Task\TaskRepository;
use RuntimeException;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Twig\Environment;

class EmailNotificationSubscriber implements EventSubscriberInterface
{
    /**
     * @var TaskRepository
     */
    private $tasks;

    /**
     * @var MemberRepository
     */
    private $members;

    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @param TaskRepository $tasks
     * @param MemberRepository $members
     * @param MailerInterface $mailer
     * @param Environment $twig
     */
    public function __construct(TaskRepository $tasks, MemberRepository $members, MailerInterface $mailer, Environment $twig)
    {
        $this->tasks = $tasks;
        $this->members = $members;
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            TaskExecutorAssigned::class => [
                ['onTaskExecutorAssignedExecutor'],
                ['onTaskExecutorAssignedAuthor']
            ],
        ];
    }

    /**
     * @param TaskExecutorAssigned $event
     * @throws TransportExceptionInterface
     */
    public function onTaskExecutorAssignedExecutor(TaskExecutorAssigned $event): void
    {
        if ($event->executorId->isEqual($event->actorId)) {
            return;
        }

        $task = $this->tasks->get($event->taskId);
        $executor = $this->members->get($event->executorId);
        $author = $task->getAuthor();

        if ($executor === $author) {
            return;
        }

        $subject = 'Task Executor Assignment';
        $email = (new TemplatedEmail())
            ->subject($subject)
            ->to(new Address($executor->getEmail()->getValue(), $executor->getName()->getFull()))
            ->htmlTemplate('mail/work/projects/task/executor-assigned-executor.html.twig')
            ->context([
                'task' => $task,
                'executor' => $executor,
            ]);

        try {
            $this->mailer->send($email);
        } catch (TransportException $e) {
            throw new RuntimeException('Unable to send message.');
        }
    }

    /**
     * @param TaskExecutorAssigned $event
     * @throws TransportExceptionInterface
     */
    public function onTaskExecutorAssignedAuthor(TaskExecutorAssigned $event): void
    {
        $task = $this->tasks->get($event->taskId);
        $executor = $this->members->get($event->executorId);
        $author = $task->getAuthor();

        if ($executor === $author) {
            return;
        }

        $subject = 'Your Task Executor Assignment';
        $email = (new TemplatedEmail())
            ->subject($subject)
            ->to(new Address($author->getEmail()->getValue(), $author->getName()->getFull()))
            ->htmlTemplate('mail/work/projects/task/executor-assigned-author.html.twig')
            ->context([
                'task' => $task,
                'author' => $author,
                'executor' => $executor,
            ]);

        try {
            $this->mailer->send($email);
        } catch (TransportException $e) {
            throw new RuntimeException('Unable to send message.');
        }
    }
}