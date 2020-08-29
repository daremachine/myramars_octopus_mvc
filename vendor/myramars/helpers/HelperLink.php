<?php declare(strict_types=1);
/**
 * Myramars Octopus MVC
 * Feel free contact me Jakub Hantak<info@myramars.cz>
 * @License MIT
 */

/**
 * Helper for routes
 */
class HelperLink
{
    /**
     * @param RouteList routeList
     */
    public static $ROUTE_LIST = null;

    /**
     * Generate router link
     *
     * @param string action
     * @param string controller
     * @param string parameters
     */
    public static function link($action, $controller, $parameters = null): string
    {
        foreach(self::$ROUTE_LIST->getRoutes() as $route)
        {
            if($route->controller == ucfirst($controller) && $route->action == ucfirst($action))
                return $route->path . ($parameters != null ? '?' . $parameters : null);
        }

        return "not_found_in_routes";
    }
}