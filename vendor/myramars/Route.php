<?php declare(strict_types=1);
/**
 * Myramars Octopus MVC
 * Feel free contact me Jakub Hantak<info@myramars.cz>
 * @License MIT
 */

/**
 * Route
 */
class Route 
{
    /**
     * @param string path
     */
    public $path = null;
    
    /**
     * @param string controller
     */
    public $controller = null;
    
    /**
     * @param string action
     */
    public $action = null;

    /**
     * @param string action
     */
    public $sitemapPriority = null;

    /**
     * Controller
     *
     * @param string path
     * @param string controller
     * @param string action
     */
    public function __construct(string $path, string $controller, string $action, string $sitemapPriority = '1.0')
    {
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;
        $this->sitemapPriority = $sitemapPriority;
    }
}