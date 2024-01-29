<?php

namespace services;

use core\exceptions\SystemError;
use models\Event;

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
        if(empty($events)) {
            throw new SystemError('No events found for current time');
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