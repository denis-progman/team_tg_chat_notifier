<?php
use core\Router;

Router::addRoute('GET', '/run_currents', function () {
    echo "My route is working!";
    exit;
});
