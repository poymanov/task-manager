<?php

declare(strict_types=1);

namespace App\Event\Dispatcher\Message;

use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class Handler implements MessageHandlerInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param Message $message
     */
    public function __invoke(Message $message)
    {
        $this->dispatcher->dispatch($message->getEvent());
    }

}