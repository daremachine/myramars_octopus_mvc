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
    public static function link($action, $controller, $parameters = null, $routeName = null): string
    {
        foreach(self::$ROUTE_LIST->getRoutes() as $route)
        {
            if($route->controller == ucfirst($controller) && $route->action == ucfirst($action))
                return substr(AppConfig::$DOCUMENT_ROOT, 0, -1) . $route->path . ($parameters != null ? '?' . $parameters : null);
        }

        return "not_found_in_routes";
    }

    /**
     * Generate router link by route name
     *
     * @param string routeName
     * @param string parameters
     */
    public static function linkRouteName($routeName, $parameters = null): string
    {
        foreach(self::$ROUTE_LIST->getRoutes() as $route)
        {
            if($route->name == $routeName) {
                return substr(AppConfig::$DOCUMENT_ROOT, 0, -1) . $route->path . ($parameters != null ? '?' . $parameters : null);
            }
        }

        return "not_found_in_routes";
    }
}