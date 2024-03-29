<?php

namespace models;

use core\helpers\Log;
use core\models\MainModel;
use models\Rule;

class Event extends MainModel
{
    protected Rule $rule;

    protected int $id;

    private string $year = "*";

    private string $month = "*";

    private string $day = "*";

    private string $weekday = "*";

    private string $hour = "*";

    private string $minute = "*";

    private string $title;

    private ?string $description = null;

    public function __construct(Rule $rule, $id, ?array $eventData = null)
    {
        $this->rule = $rule;
        $this->id = $id;
        if ($eventData) {
            foreach ($eventData as $key => $value) {
                $key = $this->toCamelCase($key);
                if(property_exists($this, $key)) {
                    $this->{$key} = $value;
                }
            }
        }
    }

    public function isNow(): bool
    {
        $now = new \DateTime();
        $now->setTimezone(new \DateTimeZone($this->rule->getTimezone()));
        $year = $now->format('Y');
        $month = $now->format('m');
        $day = $now->format('d');
        $weekday = $now->format('N');
        $hours = $now->format('H');
        $minutes = $now->format('i');
        Log::log("Year: $year | Month: $month | Day: $day | Weekday: $weekday | Hours: $hours | Minutes: $minutes", "event_check");

        return ($this->year === '*' || $this->year === $year)
            && ($this->month === '*' || $this->month === $month)
            && ($this->day === '*' || $this->day === $day)
            && ($this->weekday === '*' || $this->weekday === $weekday)
            && ($this->hour === '*' || $this->hour === $hours)
            && ($this->minute === '*' || $this->minute === $minutes);
    }

    public function getRule(): Rule
    {
        return $this->rule;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

}