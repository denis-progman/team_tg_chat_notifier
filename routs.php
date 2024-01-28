<?php
/**
 * @var \core\Router $router
 */

$router->addRoute('GET', '/run_currents', function ($blogID) {
    echo "My route is working with blogID => $blogID !";
    exit;
});
