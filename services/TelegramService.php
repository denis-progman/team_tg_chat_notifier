<?php

namespace services;

use models\Event;
use sdks\TelegramBotApiSdk;

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