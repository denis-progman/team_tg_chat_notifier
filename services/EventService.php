<?php

namespace services;

use core\exceptions\UserError;
use core\helpers\Log;
use models\Event;

class EventService
{
    /**
     * @return Event[]
     * @throws UserError
     */
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
            Log::log("No events found for current time", "empty_launches");
            throw new UserError('No events found for current time');
        }
        return $events;
    }

    public static function createEventMessage(Event $event): string
    {
        $message = "Event: {$event->getTitle()}\n\n";
        $message .= "{$event->getDescription()}\n";
        return $message;
    }

}