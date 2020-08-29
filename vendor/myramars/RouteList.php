<?php declare(strict_types=1);
/**
 * Myramars Octopus MVC
 * Feel free contact me Jakub Hantak<info@myramars.cz>
 * @License MIT
 */

/**
 * RouteList holds routes
 */
class RouteList 
{
    /**
     * @param Route[] Routes
     */
    private $_routes = [];

    /**
     * Add route
     *
     * @param Route Route
     */
    public function addRoute(Route $route)
    {
        $this->_routes[] = $route;
    }

    /**
     * @param Route[] Routes
     */
    public function getRoutes(): array
    {
        return $this->_routes;
    }
}