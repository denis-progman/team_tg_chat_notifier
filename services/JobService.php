<?php

namespace services;

class JobService
{
    public static function runCurrentTimeJobs(): void
    {
        $events = EventService::getCurrentEvents();
        $telegramService = new TelegramService();
        foreach ($events as $event) {
            $telegramService->sendNotificationMessage($event);
        }
    }
}