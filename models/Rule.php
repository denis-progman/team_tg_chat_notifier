<?php

namespace models;

use models\Event;

class Rule
{
    private string $filePath;

    private string $timezone;

    private string $chatId;

    /**
     * @var Event[]
     */
    private array $events;

    public function __construct(string $file)
    {
        $this->filePath = $file;
        $ruleData = json_decode(file_get_contents($file), true);
        $this->timezone = $ruleData['timezone'] ?? 'UTC';
        $this->chatId = $ruleData['chat_id'];

        foreach ($ruleData['events'] as $id => $eventData) {
            $this->events[] = new Event($this, $id, $eventData);
        }
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }
    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * @param string $filePath
     */
    public function setFilePath(string $filePath): void
    {
        $this->filePath = $filePath;
    }

    public function getEvents(): array
    {
        return $this->events;
    }

    public function addEvent(Event $event): void
    {
        $this->events[] = $event;
    }

    public function getChatId(): string
    {
        return $this->chatId;
    }

}