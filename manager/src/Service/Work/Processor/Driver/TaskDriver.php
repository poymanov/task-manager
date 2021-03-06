<?php

declare(strict_types=1);

namespace App\Service\Work\Processor\Driver;

use App\ReadModel\Work\Projects\Task\TaskFetcher;
use Twig\Environment;

class TaskDriver implements Driver
{
    private const PATTERN = '/\@[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}/i';

    /**
     * @var TaskFetcher
     */
    private $tasks;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @param TaskFetcher $tasks
     * @param Environment $twig
     */
    public function __construct(TaskFetcher $tasks, Environment $twig)
    {
        $this->tasks = $tasks;
        $this->twig = $twig;
    }

    /**
     * @inheritDoc
     */
    public function process(string $text): string
    {
        return preg_replace_callback(self::PATTERN, function (array $matches) {
            $id = ltrim($matches[0], '@');
            if (!$task = $this->tasks->find($id)) {
                return $matches[0];
            }
            return $this->twig->render('processor/work/task.html.twig', [
                'task' => $task
            ]);
        }, $text);
    }
}