<?php
require_once "constants.php";

setEnv();

function env(string $key, string $default = ''): string {
    return $_ENV[$key] ?? $default;
}

function setEnv(): void {
    $_ENV = parse_ini_file('.env', false, INI_SCANNER_RAW);
}

function config(string $param, string $default = ''): mixed {
    $paramParts = explode('.', $param);
    $config = include 'config.php';
    foreach ($paramParts as $paramPart) {
        if (isset($config[$paramPart])) {
            $config = $config[$paramPart];
        } else {
            return $default;
        }
    }
    return $config;
}
