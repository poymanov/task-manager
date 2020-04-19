<?php

namespace App\Model;

trait EventsTrait
{
    private $recordedEvents = [];

    /**
     * @param object $event
     */
    protected function recordEvent(object $event): void
    {
        $this->recordedEvents[] = $event;
    }

    /**
     * @return array
     */
    public function releaseEvents(): array
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];
        return $events;
    }
}