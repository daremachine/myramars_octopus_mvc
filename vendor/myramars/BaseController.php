<?php declare(strict_types=1);
/**
 * Myramars Octopus MVC
 * Feel free contact me Jakub Hantak<info@myramars.cz>
 * @License MIT
 */

class BaseController
{
    /**
     * Page title
     * 
     * @param string pageTitle
     */
    public $pageTitle = null;

    /**
     * Layout file name
     * 
     * @param string layoutName
     */
    public $layout = null;

    /**
     * Http request
     * 
     * @param Request request
     */
    public $request = null;

    /**
     * Constructor
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Redirect to controller action
     * 
     * @param string action
     * @param string controller
     * @param string parameters
     */
    public function redirect($action, $controller, $parameters = null): void
    {
        $url = HelperLink::link($action, $controller, $parameters);
        header("Location: {$url}");
        die();
    }

    /**
     * Redirect to specific url
     * 
     * @param string url
     */
    public function redirectTo($url): void
    {
        header("Location: {$url}");
        die();
    }

    /**
     * Set layout file
     * 
     * @param string layoutName
     */
    public function setLayout($layoutName): void
    {
        $this->layout = $layoutName;
    }
}