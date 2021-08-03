<?php declare(strict_types=1);
/**
 * Myramars Octopus MVC
 * Feel free contact me Jakub Hantak<info@myramars.cz>
 * @License MIT
 */
include('../vendor/myramars/RobotLoader.php');

// load vendor files
RobotLoader::load();

// routes
$routes = new RouteList();
$routes->addRoute(new Route('/kontakty', 'Home', 'Contact'));

// app run
(new Bootstrap())->setRoutes($routes)->run();