<?php
require_once "init.php";

use core\Router;

try {
    Router::matchRoute();
} catch (Exception $e) {
    echo $e->getMessage();
}