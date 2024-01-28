<?php

namespace core;

use exceptions\SystemError;

class Router {
    protected static $routes = []; // stores routes

    public static function addRoute(string $method, string $url, callable $target) {
        self::$routes[$method][$url] = $target;
    }

    public static function matchRoute() {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['REQUEST_URI'];
        if (isset(self::$routes[$method])) {
            foreach (self::$routes[$method] as $routeUrl => $target) {
                $pattern = preg_replace('/\/:([^\/]+)/', '/(?P<$1>[^/]+)', $routeUrl);
                if (preg_match('#^' . $pattern . '$#', $url, $matches)) {
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY); // Only keep named subpattern matches
                    call_user_func_array($target, $params);
                    return;
                }
            }
        }
        throw new SystemError('Route not found');
    }
}