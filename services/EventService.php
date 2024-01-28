<?php

namespace services;

use models\Event;
use models\Rule;

class EventService
{
    public static function getCurrentEvents(): array
    {
        $events = [];
        $rules = RuleService::getRules();
        foreach ($rules as $rule) {
            foreach ($rule->getEvents() as $event) {
                if ($event->isNow()) {
                    $events[] = $event;
                }
            }
        }
        return $events;
    }

    public static function createEventMessage(Event $event): string
    {
        $message = "Event: {$event->getTitle()}\n";
        $message .= "Description: {$event->getDescription()}\n";
        return $message;
    }

}