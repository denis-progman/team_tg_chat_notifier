<?php

namespace core\models;

class Loger
{
    const DEFAULT_LOG_FILE = 'log';

    const ERROR_LOG_TYPE = 'error';

    const INFO_LOG_TYPE = 'info';

    const WARNING_LOG_TYPE = 'warning';

    public static function log(string $message, string $type): void
    {
        $logFile = fopen(LOGS_FOLDER . (self::DEFAULT_LOG_FILE ?? $type), 'a');
        fwrite($logFile, self::createLogMessage($message, $type) . PHP_EOL);
        fclose($logFile);
    }

    public static function createLogMessage(string $message, string $type): string
    {
        return "- " . date('Y-m-d H:i:s') . " [" . strtoupper($type) . "]\n{$message}";
    }

    public static function error(string $message): void
    {
        self::log($message, self::ERROR_LOG_TYPE);
    }

    public static function info(string $message): void
    {
        self::log($message, self::INFO_LOG_TYPE);
    }

    public static function warning(string $message): void
    {
        self::log($message, self::WARNING_LOG_TYPE);
    }

    public static function getLog(string $logFile): string
    {
        return file_get_contents(LOGS_FOLDER . $logFile);
    }
}