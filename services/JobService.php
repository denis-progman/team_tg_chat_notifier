<?php

namespace services;

use core\exceptions\UserError;
use core\helpers\Log;

class JobService
{
    /**
     * @throws UserError
     */
    public static function runCurrentTimeJobs(): int
    {
        $events = EventService::getCurrentEvents();
        $telegramService = new TelegramService();
        Log::log(
            "Running events:\n" . print_r($events, true),
            "lunches"
        );
        $count = 0;
        foreach ($events as $event) {
            $telegramService->sendNotificationMessage($event);
            $count++;
        }
        print_r("{$count} events have been run successfully!");
        Log::log(
            "$count events have been run successfully!",
            "lunches"
        );
        return $count;
    }
}