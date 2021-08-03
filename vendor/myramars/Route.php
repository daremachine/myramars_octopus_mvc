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
     * @param string name
     */
    public $name = null;

    /**
     * @param string controller
     */
    public $controller = null;
    
    /**
     * @param string action
     */
    public $action = null;

    /**
     * @param string sitemapPriority
     */
    public $sitemapPriority = null;

    /**
     * @param bool isStandalone
     */
    public $isStandalone = false;

    /**
     * @param string standaloneTemplateName
     */
    public $standaloneTemplateName = null;

    /**
     * Controller
     *
     * @param string path
     * @param string controller
     * @param string action
     */
    public function __construct(string $path, string $controller, $action, string $sitemapPriority = '1.0')
    {
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;
        $this->sitemapPriority = $sitemapPriority;
    }

    /**
     * Set route to standalone template without controller action
     */
    public function asStandalone($templateName)
    {
        $this->isStandalone = true;
        $this->standaloneTemplateName = $templateName;

        return $this;
    }

    /**
     * Set route name
     */
    public function setRouteName($name)
    {
        $this->name = $name;

        return $this;
    }
}