<?php

declare(strict_types=1);

namespace App\Event\Dispatcher;

use App\Event\Dispatcher\Message\Message;
use App\Model\EventDispatcher;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerEventDispatcher implements EventDispatcher
{
    /**
     * @var MessageBusInterface
     */
    private $bus;

    /**
     * @param MessageBusInterface $bus
     */
    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @param array $events
     */
    public function dispatch(array $events): void
    {
        foreach ($events as $event) {
            $this->bus->dispatch(new Message($event));
        }
    }
}