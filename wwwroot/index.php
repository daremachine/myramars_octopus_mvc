<?php declare(strict_types=1);
ini_set('display_errors', '1'); ini_set('display_startup_errors', '1'); error_reporting(E_ALL);

/**
 * Myramars Octopus MVC
 * Feel free contact me Jakub Hantak<info@myramars.cz>
 * @License MIT
 */
include('../vendor/myramars/RobotLoader.php');

// load vendor files
RobotLoader::load();
if(AppConfig::$LOADER_DEBUG) die;

// routes
$routes = new RouteList();
$routes->addRoute(new Route('/kontakty', 'Home', 'Contact'));
$routes->addRoute((new Route('/standalone', 'Home', null))->asStandalone('standaloneWithoutCtrl')->setRouteName('sta_route'));
$routes->addRoute(new RouteStandAlone('/standalone-2', 'Home', 'standAloneWithoutCtrl', new ContextMetadata("Standalone route without Ctrl", "Seo description of page", 'Seo keywords'), 'sta_route'));

// app run
(new Bootstrap())->setRoutes($routes)->run();