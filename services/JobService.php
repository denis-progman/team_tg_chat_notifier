<?php

namespace services;

use core\exceptions\UserError;

class JobService
{
    /**
     * @throws UserError
     */
    public static function runCurrentTimeJobs(): int
    {
        $events = EventService::getCurrentEvents();
        $telegramService = new TelegramService();
        $count = 0;
        foreach ($events as $event) {
            $telegramService->sendNotificationMessage($event);
            $count++;
        }
        return $count;
    }
}