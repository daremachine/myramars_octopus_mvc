<?php declare(strict_types=1);
/**
 * Myramars Octopus MVC
 * Feel free contact me Jakub Hantak<info@myramars.cz>
 * @License MIT
 */

/**
 * Router url path to route object
 */
class Router
{
    /**
     * @param RouteList RouteList
     */
    private $_routeList = null;

    /**
     * Constructor
     *
     * @param RouteList routeList
     */
    public function __construct(RouteList $routeList)
    {
        // add default route Home/index
        $routeList->addRoute(new Route(WebSettings::$DOCUMENT_ROOT, 'Home', 'Index'));

        $this->_routeList = $routeList;
    }

    /**
     * Get route
     *
     * @param Route Route
     * @throw RouteNotFoundException
     */
    public function GetRoute(): Route
    {
        // current route
        $currentRoutePath = explode('?', $_SERVER["REQUEST_URI"])[0];

        // find route
        foreach($this->_routeList->getRoutes() as $route)
        {
            if($route->path == $currentRoutePath) return $route;
        }

        throw new RouteNotFoundException('Route {$route->path} not found in route list');
    }
}