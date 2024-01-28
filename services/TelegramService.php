<?php

namespace services;

use App\sdks\TelegramBotApiSdk;
use models\Event;

class TelegramService
{

    private TelegramBotApiSdk $botInstance;

    public function __construct()
    {
        $this->botInstance = new TelegramBotApiSdk();
    }

    public function sendNotificationMessage(Event $event): void
    {
        $message = EventService::createEventMessage($event);
        $this->botInstance->sendMessage(
            $message,
            $event->getRule()->getChatId(),
        );
    }
}