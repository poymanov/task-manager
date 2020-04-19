<?php

declare(strict_types=1);

namespace App\Event\Dispatcher\Message;

class Message
{
    /**
     * @var object
     */
    private $event;

    /**
     * @param object $event
     */
    public function __construct(object $event)
    {
        $this->event = $event;
    }

    /**
     * @return object
     */
    public function getEvent(): object
    {
        return $this->event;
    }
}