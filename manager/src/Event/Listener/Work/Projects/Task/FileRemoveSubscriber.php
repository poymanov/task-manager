<?php

declare(strict_types=1);

namespace App\Event\Listener\Work\Projects\Task;

use App\Model\Work\Entity\Projects\Task\Event\TaskFileRemoved;
use App\Service\Uploader\FileUploader;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class FileRemoveSubscriber implements EventSubscriberInterface
{
    /**
     * @var FileUploader
     */
    private $uploader;

    /**
     * @param FileUploader $uploader
     */
    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            TaskFileRemoved::class => 'onTaskFileRemoved',
        ];
    }

    public function onTaskFileRemoved(TaskFileRemoved $event): void
    {
        $this->uploader->remove($event->info->getPath(), $event->info->getName());
    }
}