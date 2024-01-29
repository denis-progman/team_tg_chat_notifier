<?php

use controllers\CronController;
use core\Router;

Router::addRoute('GET', '/run_currents', function () {
    CronController::run();
    exit;
});
